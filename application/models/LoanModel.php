<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoanModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Count overdue loans
    public function get_overdue_count()
	{
		$query = $this->db->query("
			SELECT COUNT(*) AS overdue_loans
			FROM (
				SELECT l.id
				FROM tbl_loan l
				LEFT JOIN tbl_payment p
					ON p.loan_id = l.id
				WHERE l.status IN ('Released', 'Partial')
				GROUP BY l.id, l.effective_date
				HAVING DATEDIFF(
					CURDATE(),
					DATE_ADD(
						l.effective_date,
						INTERVAL COUNT(p.id) MONTH
					)
				) > 0
			) overdue
		");

		return (int) $query->row()->overdue_loans;
	}



    
}