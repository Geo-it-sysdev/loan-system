<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class ReportController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
    }


   public function overdue_loans()
    {
        $query = $this->db->query("
            SELECT
                l.id,
                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,

                CONCAT(
                    b.firstname,' ',
                    IFNULL(b.middlename,''),
                    ' ',
                    b.lastname
                ) AS borrower_name,

                DATE_ADD(
                    l.effective_date,
                    INTERVAL COUNT(p.id) MONTH
                ) AS due_date,

                DATEDIFF(
                    CURDATE(),
                    DATE_ADD(
                        l.effective_date,
                        INTERVAL COUNT(p.id) MONTH
                    )
                ) AS days_overdue,

                l.monthly_payment,

                GREATEST(
                    DATEDIFF(
                        CURDATE(),
                        DATE_ADD(
                            l.effective_date,
                            INTERVAL COUNT(p.id) MONTH
                        )
                    ),
                    0
                ) AS penalty,

                (
                    l.monthly_payment +
                    GREATEST(
                        DATEDIFF(
                            CURDATE(),
                            DATE_ADD(
                                l.effective_date,
                                INTERVAL COUNT(p.id) MONTH
                            )
                        ),
                        0
                    )
                ) AS total_due

            FROM tbl_loan l
            INNER JOIN tbl_borrower b ON b.id = l.borrower_id
            LEFT JOIN tbl_payment p ON p.loan_id = l.id

            WHERE l.status IN ('Released', 'Partial')

            GROUP BY l.id
            HAVING days_overdue > 0
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }


    public function outstanding_loans()
    {
        $query = $this->db->query("
            SELECT 
                l.id AS loan_id,
                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,
                l.interest_rate,
                l.total_balance,
                l.effective_date,

                CONCAT(
                    b.firstname,' ',
                    IFNULL(b.middlename,''),' ',
                    b.lastname
                ) AS borrower_name,

                l.loan_amount,
                l.unearned_interest,
                l.total_balance,

                IFNULL(SUM(p.payment_amount), 0) AS total_paid,

                GREATEST(
                    (CAST(l.total_balance AS DECIMAL(12,2)) - IFNULL(SUM(p.payment_amount), 0)),
                    0
                ) AS remaining_balance,

                DATE_ADD(
                    l.effective_date,
                    INTERVAL (
                        FLOOR(
                            IFNULL(SUM(p.payment_amount), 0) / NULLIF(CAST(l.monthly_payment AS DECIMAL(12,2)), 0)
                        ) + 1
                    ) MONTH
                ) AS next_due_date

            FROM tbl_loan l
            INNER JOIN tbl_borrower b ON b.id = l.borrower_id
            LEFT JOIN tbl_payment p ON p.loan_id = l.id

            WHERE l.status IN ('Released', 'Partial')

            GROUP BY 
                l.id,
                l.interest_rate,
                l.total_balance,
                l.effective_date,
                b.firstname,
                b.middlename,
                b.lastname,
                l.loan_amount,
                l.monthly_payment

       
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }


  public function payment_collection()
    {
        $startDate = $this->input->post('startDate');
        $endDate   = $this->input->post('endDate');

        $where = "";

        if (!empty($startDate) && !empty($endDate)) {
            $where = "WHERE DATE(p.date_payment) BETWEEN '$startDate' AND '$endDate'";
        } elseif (!empty($startDate)) {
            $where = "WHERE DATE(p.date_payment) >= '$startDate'";
        } elseif (!empty($endDate)) {
            $where = "WHERE DATE(p.date_payment) <= '$endDate'";
        }

        $query = $this->db->query("
            SELECT
                p.id,
                p.payment_no,
                p.id AS receipt_no,
                p.date_payment,

                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,

                CONCAT(
                    b.firstname,' ',
                    IFNULL(b.middlename,''),' ',
                    b.lastname
                ) AS borrower_name,

                CAST(p.payment_amount AS DECIMAL(12,2)) AS payment_amount,
                CAST(IFNULL(p.penalty,0) AS DECIMAL(12,2)) AS penalty,
                p.collector,

                CAST(
                    (p.payment_amount - (l.loan_amount * (l.interest_rate / 100)))
                AS DECIMAL(12,2)) AS principal_paid,

                CAST(
                    p.payment_amount - (
                        p.payment_amount - (l.loan_amount * (l.interest_rate / 100))
                    )
                AS DECIMAL(12,2)) AS interest_paid

            FROM tbl_payment p
            INNER JOIN tbl_loan l ON l.id = p.loan_id
            INNER JOIN tbl_borrower b ON b.id = p.borrower_id

            $where

            ORDER BY p.date_payment DESC
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }

    public function fully_paid_loans()
    {
        $startDate = $this->input->post('startDate');
        $endDate   = $this->input->post('endDate');

        $having = "";

        if (!empty($startDate) && !empty($endDate)) {
            $having = " HAVING DATE(MAX(p.date_payment)) BETWEEN "
                    . $this->db->escape($startDate)
                    . " AND "
                    . $this->db->escape($endDate);
        }

        $query = $this->db->query("
            SELECT
                l.id AS loan_id,

                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,

                CONCAT(
                    b.firstname, ' ',
                    IFNULL(b.middlename, ''),
                    ' ',
                    b.lastname
                ) AS borrower_name,

                l.effective_date,
                l.loan_amount,
                l.interest_rate,
                l.total_balance,

                IFNULL(SUM(p.payment_amount),0) AS total_paid,

                GREATEST(
                    CAST(l.loan_amount AS DECIMAL(12,2)) - IFNULL(SUM(p.payment_amount),0),
                    0
                ) AS remaining_balance,

                l.unearned_interest AS total_interest_earned,

                l.date_created AS date_released,

                MAX(p.date_payment) AS date_fully_paid

            FROM tbl_loan l

            LEFT JOIN tbl_borrower b
                ON b.id = l.borrower_id

            LEFT JOIN tbl_payment p
                ON p.loan_id = l.id

            WHERE l.status = 'fully'

            GROUP BY l.id

            $having

            ORDER BY l.id DESC
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }

    public function released_loans()
    {
        $startDate = $this->input->post('startDate');
        $endDate   = $this->input->post('endDate');

        $this->db->select("
            l.id AS loan_id,
            DATE(l.date_created) AS release_date,
            CONCAT('RN-', LPAD(l.id,6,'0')) AS ref_no,

            CONCAT(
                b.firstname,' ',
                IFNULL(b.middlename,''),' ',
                b.lastname
            ) AS borrower_name,

            l.loan_amount,
            l.loan_plan,
            l.interest_rate
        ");

        $this->db->from('tbl_loan l');
        $this->db->join('tbl_borrower b','b.id=l.borrower_id','left');

        $this->db->where_in('l.status', ['Released','Partial','Fully']);

        // Date Filter
        if (!empty($startDate) && !empty($endDate)) {

            $this->db->where('DATE(l.date_created) >=', $startDate);
            $this->db->where('DATE(l.date_created) <=', $endDate);

        } elseif (!empty($startDate)) {

            $this->db->where('DATE(l.date_created)', $startDate);

        } elseif (!empty($endDate)) {

            $this->db->where('DATE(l.date_created)', $endDate);
        }

        $this->db->order_by('l.id','DESC');

        $query = $this->db->get();

        echo json_encode([
            'data' => $query->result()
        ]);
    }


    public function get_loan_details()
    {
        $loan_id = $this->input->post('loan_id');

        $query = $this->db->query("
            SELECT
                b.*,
                l.*

            FROM tbl_borrower b

            LEFT JOIN tbl_loan l
                ON b.id = l.borrower_id

            WHERE l.id = ?
        ", [$loan_id]);

        echo json_encode($query->row());
    }


    public function monthly_collection()
    {
        $year = $this->input->post('year');

        $where = '';

        if (!empty($year)) {
            $where = "WHERE YEAR(p.date_payment) = '$year'";
        }

        $query = $this->db->query("
            SELECT
                DATE_FORMAT(p.date_payment, '%M %Y') AS month,

                SUM(
                    CAST(p.payment_amount AS DECIMAL(15,2))
                ) 
                -
                ROUND(
                    SUM(
                        (
                            CAST(l.monthly_payment AS DECIMAL(15,2))
                            -
                            (
                                CAST(l.loan_amount AS DECIMAL(15,2))
                                /
                                CAST(l.loan_plan AS UNSIGNED)
                            )
                        )
                    ), 2
                ) AS principal_collected,

                ROUND(
                    SUM(
                        (
                            CAST(l.monthly_payment AS DECIMAL(15,2))
                            -
                            (
                                CAST(l.loan_amount AS DECIMAL(15,2))
                                /
                                CAST(l.loan_plan AS UNSIGNED)
                            )
                        )
                    )
                ) AS interest_collected,

                SUM(
                    CAST(IFNULL(p.penalty,0) AS DECIMAL(15,2))
                ) AS penalties_collected,

                SUM(
                    CAST(p.payment_amount AS DECIMAL(15,2))
                    +
                    CAST(IFNULL(p.penalty,0) AS DECIMAL(15,2))
                ) AS total_collection

            FROM tbl_payment p

            INNER JOIN tbl_loan l
                ON l.id = p.loan_id

            $where

            GROUP BY
                YEAR(p.date_payment),
                MONTH(p.date_payment),
                DATE_FORMAT(p.date_payment, '%M %Y')

            ORDER BY
                YEAR(p.date_payment) DESC,
                MONTH(p.date_payment) DESC
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }


}