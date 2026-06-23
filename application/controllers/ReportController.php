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

                IFNULL(SUM(p.payment_amount), 0) AS total_paid,

                GREATEST(
                    (CAST(l.loan_amount AS DECIMAL(12,2)) - IFNULL(SUM(p.payment_amount), 0)),
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

            HAVING remaining_balance > 0
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }


    public function payment_collection()
    {
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

            ORDER BY p.id ASC
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }

    public function fully_paid_loans()
    {
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
                (GREATEST(
                    (CAST(l.loan_amount AS DECIMAL(12,2)) - IFNULL(SUM(p.payment_amount),0)),
                    0
                )) AS remaining_balance,

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

            ORDER BY l.id DESC
        ");

        echo json_encode([
            'data' => $query->result()
        ]);
    }


}