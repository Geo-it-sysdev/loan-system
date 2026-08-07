<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** @property CI_DB_query_builder $db */
class AdminController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('upload');
        if (!$this->session->userdata('logged_in')) {
            redirect('LoginController/logout');
        }
    }

    // Dashboard
    public function get_dashboard_stats()
    {
        // Total Borrowers
        $total_borrowers = $this->db->count_all('tbl_borrower');

        // Total Loan Release
        $this->db->from('tbl_loan');
        $this->db->where_in('status', ['Released', 'Partial', 'Fully']);
        $total_release = $this->db->count_all_results();

        // Remaining Balance
        $this->db->from('tbl_loan');
        $this->db->where_in('status', ['Released', 'Partial']);
        $remaining_balance = $this->db->count_all_results();

        // Total Paid
        $this->db->from('tbl_loan');
        $this->db->where('status', 'Fully');
        $total_paid = $this->db->count_all_results();

        // ============================
        // Total Capital (Loan Amount)
        // ============================
        $total_capital = $this->db
            ->select('SUM(CAST(loan_amount AS DECIMAL(15,2))) AS total')
            ->get('tbl_loan')
            ->row()
            ->total;

        // ============================
        // Total Interest
        // ============================
        $total_interest = $this->db
            ->select('SUM(CAST(unearned_interest AS DECIMAL(15,2))) AS total')
            ->get('tbl_loan')
            ->row()
            ->total;

        // ============================
        // Total Earned
        // (Fully Paid Loans)
        // ============================
        $total_earned = $this->db
            ->select('SUM(CAST(unearned_interest AS DECIMAL(15,2))) AS total')
            ->where('status', 'Fully')
            ->get('tbl_loan')
            ->row()
            ->total;

        // ============================
        // Total Unearned
        // (Pending, Released, Partial)
        // ============================
        $total_unearned = $this->db
            ->select('SUM(CAST(unearned_interest AS DECIMAL(15,2))) AS total')
            ->where_in('status', ['Pending', 'Released', 'Partial'])
            ->get('tbl_loan')
            ->row()
            ->total;

        echo json_encode([
            'status' => true,

            // Existing
            'total_borrowers'   => $total_borrowers,
            'total_release'     => $total_release,
            'remaining_balance' => $remaining_balance,
            'total_paid'        => $total_paid,

            // New
            'total_capital'     => number_format($total_capital ?: 0, 2),
            'total_interest'    => number_format($total_interest ?: 0, 2),
            'total_earned'      => number_format($total_earned ?: 0, 2),
            'total_unearned'    => number_format($total_unearned ?: 0, 2),
        ]);
    }



    public function get_revenue_chart()
    {
        $year = $this->input->get('year');

        if ($year == 'this' || empty($year)) {
            $year = date('Y');
        }

        $invest = array_fill(1, 12, 0);
        $income = array_fill(1, 12, 0);
        $unearned = array_fill(1, 12, 0);

        $query = $this->db->query("
            SELECT
                MONTH(effective_date) AS month_no,

                SUM(loan_amount) AS total_invest,

                SUM(
                    CASE
                        WHEN status IN ('Released','Partial')
                        THEN unearned_interest
                        ELSE 0
                    END
                ) AS total_unearned,

                SUM(
                    CASE
                        WHEN status = 'Fully'
                        THEN unearned_interest
                        ELSE 0
                    END
                ) AS total_income

            FROM tbl_loan
            WHERE YEAR(effective_date) = ?
            GROUP BY MONTH(effective_date)
        ", [$year]);

        foreach ($query->result() as $row) {

            $month = (int)$row->month_no;

            $invest[$month] = (float)$row->total_invest;
            $income[$month] = (float)$row->total_income;
            $unearned[$month] = (float)$row->total_unearned;
        }

        echo json_encode([
            'invest'   => array_values($invest),
            'income'   => array_values($income),
            'unearned' => array_values($unearned)
        ]);
    }



    // ===== Collectors function======
	public function add_collector()
    {
        $fullname       = $this->input->post('fullname', true);
        $username       = $this->input->post('username', true);
        $collector_type = $this->input->post('collector_type', true);

        $email      = $this->input->post('email', true);
        $contact_no = $this->input->post('contact', true);

        $province     = $this->input->post('Province', true);
        $municipality = $this->input->post('municipalities', true);
        $barangay     = $this->input->post('baranggay', true);
        $purok        = $this->input->post('Purok', true);

        $address = $purok . ', ' . $barangay . ', ' . $municipality . ', ' . $province;

        $password = password_hash('143', PASSWORD_DEFAULT);

        if ($this->db->where('fullname', $fullname)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Full name already exists'
            ]);
            return;
        }

        if ($this->db->where('username', $username)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username already exists'
            ]);
            return;
        }

        if ($this->db->where('email', $email)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
            return;
        }

        if ($this->db->where('contact_no', $contact_no)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Contact number already exists'
            ]);
            return;
        }

        $photo_path = null;

        if (!empty($_FILES['photo']['name'])) {

            $upload_path = FCPATH . 'assets/collector/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $filename = preg_replace('/[^A-Za-z0-9]/', '_', $fullname) . '_' . time();

            $config['upload_path']   = $upload_path;

            $config['allowed_types'] = 'jpg|jpeg|png|webp|bmp|heic|heif';

            $config['max_size']      = 20480;

            $config['file_name']     = $filename;
            $config['overwrite']     = true;

            $config['max_width']     = 0;
            $config['max_height']    = 0;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {

                $file = $this->upload->data();
                $photo_path = 'assets/collector/' . $file['file_name'];

            } else {

                echo json_encode([
                    'status'  => 'error',
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }

        $data = [
            'fullname'       => $fullname,
            'username'       => $username,
            'password'       => $password,
            'collector_type' => $collector_type,
            'address'        => $address,
            'email'          => $email,
            'contact_no'     => $contact_no,
            'photo'          => $photo_path,
            'date_created'   => date('Y-m-d')
        ];

        $insert = $this->db->insert('tbl_collector', $data);

        echo json_encode([
            'status' => $insert ? 'success' : 'error',
            'message' => $insert
                ? 'Collector added successfully. Default password is 143.'
                : 'Failed to add collector'
        ]);
    }

	public function update_collector()
    {
        $id = $this->input->post('collector_id');

        $fullname       = $this->input->post('fullname', true);
        $username       = $this->input->post('username', true);
        $collector_type = $this->input->post('collector_type', true);

        $email      = $this->input->post('email', true);
        $contact_no = $this->input->post('contact', true);

        $province     = $this->input->post('Province', true);
        $municipality = $this->input->post('municipalities', true);
        $barangay     = $this->input->post('baranggay', true);
        $purok        = $this->input->post('Purok', true);

        $address = $purok . ', ' . $barangay . ', ' . $municipality . ', ' . $province;

        $collector = $this->db
            ->where('id', $id)
            ->get('tbl_collector')
            ->row();

        if (!$collector) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Collector not found'
            ]);
            return;
        }


        if ($this->db->where('fullname', $fullname)->where('id !=', $id)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Full name already exists'
            ]);
            return;
        }

        if ($this->db->where('username', $username)->where('id !=', $id)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username already exists'
            ]);
            return;
        }

        if ($this->db->where('email', $email)->where('id !=', $id)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email already exists'
            ]);
            return;
        }

        if ($this->db->where('contact_no', $contact_no)->where('id !=', $id)->get('tbl_collector')->row()) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Contact number already exists'
            ]);
            return;
        }

       $photo_path = $collector->photo;

        if (!empty($_FILES['photo']['name'])) {

            $upload_path = FCPATH . 'assets/collector/';

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $filename = preg_replace('/[^A-Za-z0-9]/', '_', $fullname) . '_' . time();

            $config['upload_path']   = $upload_path;

            $config['allowed_types'] = 'jpg|jpeg|png|webp|bmp|heic|heif';

            $config['max_size']      = 20480;

            $config['file_name']     = $filename;
            $config['overwrite']     = true;

            $config['max_width']     = 0;
            $config['max_height']    = 0;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {

                if (!empty($collector->photo) && file_exists(FCPATH . $collector->photo)) {
                    unlink(FCPATH . $collector->photo);
                }

                $file = $this->upload->data();
                $photo_path = 'assets/collector/' . $file['file_name'];

            } else {

                echo json_encode([
                    'status'  => 'error',
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }

        $data = [
            'fullname'       => $fullname,
            'username'       => $username,
            'collector_type' => $collector_type,
            'address'        => $address,
            'email'          => $email,
            'contact_no'     => $contact_no,
            'photo'          => $photo_path
        ];

        $update = $this->db
            ->where('id', $id)
            ->update('tbl_collector', $data);

        echo json_encode([
            'status' => $update ? 'success' : 'error',
            'message' => $update
                ? 'Collector updated successfully.'
                : 'Failed to update collector'
        ]);
    }


	public function delete_collector()
	{
		$id = $this->input->post('id');

		$collector = $this->db
			->where('id', $id)
			->get('tbl_collector')
			->row();

		if (!$collector) {

			echo json_encode([
				'status' => 'error',
				'message' => 'Collector not found.'
			]);
			return;
		}

		if (!empty($collector->photo)) {

			$photo_file = FCPATH . $collector->photo;

			if (file_exists($photo_file)) {
				unlink($photo_file);
			}
		}

		$delete = $this->db
			->where('id', $id)
			->delete('tbl_collector');

		echo json_encode([
			'status' => $delete ? 'success' : 'error',
			'message' => $delete
				? 'Collector deleted successfully.'
				: 'Failed to delete collector.'
		]);
	}

	public function get_collectors()
	{
		$data = $this->db->order_by('id', 'DESC')
						->get('tbl_collector')
						->result();

		foreach ($data as $row) {

			if ($row->photo) {
				$row->photo = base_url($row->photo);
			} else {
				$row->photo = base_url('assets/images/user.png');
			}
		}

		echo json_encode($data);
	}


    //====== Interest Rates ======
	public function fetch_interest_rate()
	{
		$result = $this->db
			->select('id, interest_rate')
			->from('tbl_interest_rate')
			->order_by('id', 'asc')
			->get()
			->result();

		echo json_encode([
			'data' => $result
		]);
	}

	public function add_interest_rate()
	{
		$interest_rate = $this->input->post('interest_rate', true);

		if (empty($interest_rate)) {
			echo json_encode([
				'status'  => false,
				'message' => 'Interest Rate is required.'
			]);
			return;
		}

		$exists = $this->db
			->where('interest_rate', $interest_rate)
			->count_all_results('tbl_interest_rate');

		if ($exists > 0) {
			echo json_encode([
				'status'  => false,
				'message' => 'Interest Rate already exists.'
			]);
			return;
		}

		$insert = $this->db->insert('tbl_interest_rate', [
			'interest_rate' => $interest_rate
		]);

		if ($insert) {
			echo json_encode([
				'status'  => true,
				'message' => 'Interest Rate added successfully.'
			]);
		} else {
			echo json_encode([
				'status'  => false,
				'message' => 'Failed to save Interest Rate.'
			]);
		}
	}

	public function delete_interest_rate()
	{
		$this->db->where('id', $this->input->post('id'));
		$delete = $this->db->delete('tbl_interest_rate');

		echo json_encode([
			'status' => $delete
		]);
	}


    //====== Borrowers ======
	public function add_borrower()
    {
        $this->load->library('upload');

        // GET FORM DATA
        $firstname   = $this->input->post('first_name', true);
        $lastname    = $this->input->post('last_name', true);
        $middlename  = $this->input->post('middle_name', true);
        $province      = $this->input->post('Province', true);
        $municipality  = $this->input->post('municipalities', true);
        $barangay      = $this->input->post('baranggay', true);
        $purok         = $this->input->post('Purok', true);
        $address = $purok . ', ' . $barangay . ', ' . $municipality . ', ' . $province;
        $email       = $this->input->post('email', true);
        $contact     = $this->input->post('contact', true);
        $id_type     = $this->input->post('id_type', true);
        $valid_id    = $this->input->post('valid_id', true);

        // DUPLICATE CHECK
        $this->db->group_start();
        $this->db->where('firstname', $firstname);
        $this->db->where('lastname', $lastname);
        $this->db->group_end();

        $this->db->or_where('email', $email);
        $this->db->or_where('contact_no', $contact);
        $this->db->or_where('valid_id_no', $valid_id);

        $check = $this->db->get('tbl_borrower');

        if ($check->num_rows() > 0) {

            echo json_encode([
                'status' => false,
                'message' => 'Duplicate record found (Name, Email, Contact or Valid ID already exists)'
            ]);
            return;
        }

        // CLEAN FILE NAME
        $clean_firstname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname));
        $clean_lastname  = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $lastname));

        $filename = $clean_firstname . '_' . $clean_lastname;

        // DEFAULT PHOTO
        $photo_path = 'assets/borrower/default.png';

        // UPLOAD PHOTO
        if (!empty($_FILES['photo']['name'])) {

            $config['upload_path']   = FCPATH . 'assets/borrower/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|bmp';
            $config['max_size']      = 10240;
            $config['overwrite']     = TRUE;
            $config['remove_spaces'] = TRUE;

            $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

            $config['file_name'] = $filename . '.' . $extension;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {

                $uploadData = $this->upload->data();

                $photo_path = 'assets/borrower/' . $uploadData['file_name'];

            } else {

                echo json_encode([
                    'status'  => false,
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }

        // INSERT DATA
        $data = [
            'firstname'    => $firstname,
            'lastname'     => $lastname,
            'middlename'   => $middlename,
            'address'      => $address,
            'email'        => $email,
            'contact_no'   => $contact,
            'type_of_id'   => $id_type,
            'valid_id_no'  => $valid_id,
            'photo'        => $photo_path,
            'date_created' => date('Y-m-d')
        ];

        $insert = $this->db->insert('tbl_borrower', $data);

        if ($insert) {
            echo json_encode([
                'status' => true,
                'message' => 'Borrower added successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to add borrower'
            ]);
        }
    }


    public function get_borrower()
    {
        $id = $this->input->post('id');

        $data = $this->db
            ->where('id', $id)
            ->get('tbl_borrower')
            ->row();

        echo json_encode([
            'status' => true,
            'data'   => $data
        ]);
    }

    public function get_municipalities()
    {
        $data = $this->db
            ->order_by('name', 'ASC')
            ->get('tbl_municipalities')
            ->result();

        echo json_encode($data);
    }

    public function get_barangays()
    {
        $municipality_id = $this->input->post('municipality_id');

        $data = $this->db
            ->distinct()
            ->select('name')
            ->where('municipality_id', $municipality_id)
            ->order_by('name', 'ASC')
            ->get('tbl_barangays')
            ->result();

        echo json_encode($data);
    }

    public function update_borrower()
    {
        $id = $this->input->post('id', true);

        $this->db->where('id', $id);
        $borrower = $this->db->get('tbl_borrower')->row();

        if (!$borrower) {
            echo json_encode([
                'status' => false,
                'message' => 'Borrower not found.'
            ]);
            return;
        }

        $address = $this->input->post('Purok', true) . ', ' .
                $this->input->post('baranggay', true) . ', ' .
                $this->input->post('municipalities', true) . ', ' .
                $this->input->post('Province', true);

        $firstname = $this->input->post('first_name', true);
        $lastname  = $this->input->post('last_name', true);

        $clean_firstname = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $firstname));
        $clean_lastname  = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $lastname));

        $filename = $clean_firstname . '_' . $clean_lastname;

        $photo_path = $borrower->photo;

        if (!empty($_FILES['photo']['name'])) {

            if (
                !empty($borrower->photo) &&
                $borrower->photo != 'assets/borrower/default.png'
            ) {

                $oldPhoto = FCPATH . $borrower->photo;

                if (is_file($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            foreach (glob(FCPATH . "assets/borrower/{$filename}.*") as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

            $config['upload_path']   = FCPATH . 'assets/borrower/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp|bmp';
            $config['max_size']      = 10240;
            $config['file_name']     = $filename . '.' . $extension;
            $config['overwrite']     = TRUE;
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if ($this->upload->do_upload('photo')) {

                $uploadData = $this->upload->data();

                $photo_path = 'assets/borrower/' . $uploadData['file_name'];

            } else {

                echo json_encode([
                    'status' => false,
                    'message' => strip_tags($this->upload->display_errors())
                ]);
                return;
            }
        }

        $data = [
            'firstname'   => $this->input->post('first_name', true),
            'lastname'    => $this->input->post('last_name', true),
            'middlename'  => $this->input->post('middle_name', true),
            'address'     => $address,
            'email'       => $this->input->post('email', true),
            'contact_no'  => $this->input->post('contact', true),
            'type_of_id'  => $this->input->post('id_type', true),
            'valid_id_no' => $this->input->post('valid_id', true),
            'photo'       => $photo_path
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tbl_borrower', $data);

        echo json_encode([
            'status' => $update,
            'message' => $update ? 'Borrower updated successfully.' : 'Update failed.'
        ]);
    }

   public function delete_borrower()
    {
        $id = $this->input->post('id', true);

        $this->db->where('id', $id);
        $borrower = $this->db->get('tbl_borrower')->row();

        if (!$borrower) {
            echo json_encode([
                'status' => false,
                'message' => 'Borrower not found.'
            ]);
            return;
        }

        if (!empty($borrower->photo)) {
            $photoPath = FCPATH . $borrower->photo;

            if (is_file($photoPath)) {
                unlink($photoPath);
            }
        }

        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_borrower');

        echo json_encode([
            'status' => $delete,
            'message' => $delete ? 'Deleted successfully.' : 'Delete failed.'
        ]);
    }

    public function borrower_list()
    {
        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];

        $totalRecords = $this->db->count_all('tbl_borrower');

        $this->db->select('*');
        $this->db->from('tbl_borrower');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('contact_no', $search);
            $this->db->group_end();
        }

        $filteredDb = clone $this->db;
        $filteredCount = $filteredDb->count_all_results('', false);

        $this->db->limit($length, $start);

        $query = $this->db->get();

        echo json_encode([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredCount,
            "data" => $query->result()
        ]);
    }


    //===== Loan ======
    public function select_borrowers()
    {
        $data = $this->db->select("id, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname")
                        ->from('tbl_borrower')
                        ->get()
                        ->result();

        echo json_encode($data);
    }

    public function get_interest_rates()
    {
        $data = $this->db->select('id, interest_rate')
                        ->from('tbl_interest_rate')
                        ->order_by('interest_rate', 'ASC')
                        ->get()
                        ->result();

        echo json_encode($data);
    }

    public function save_loan()
    {
        date_default_timezone_set('Asia/Manila');

        $data = array(
            'borrower_id'            => $this->input->post('borrower_id'),
            'added_by'  => $this->session->userdata('id'),
            'loan_purpose'           => $this->input->post('loan_purpose'),

            'co_maker'               => $this->input->post('co_maker_name'),
            'co_maker_contact'       => $this->input->post('co_maker_contact'),
            'relationship'           => $this->input->post('relationship'),
            'collateral'             => $this->input->post('collateral'),
            'loan_plan'              => $this->input->post('loan_plan'),
            'effective_date'         => $this->input->post('effective_date'),
            'loan_amount'            => str_replace(',', '', $this->input->post('principal_amount')),
            'interest_rate'          => $this->input->post('interest_rate'),
            'monthly_payment'        => $this->input->post('monthly_payment'),
            'unearned_interest'      => $this->input->post('unearned_interest'),
            'total_balance'          => $this->input->post('total_balance'),
            'date_created'           => date('Y-m-d H:i:s'),
            'status'                 => 'Pending'
        );

        $insert = $this->db->insert('tbl_loan', $data);

        if ($insert) {
            echo json_encode([
                'status' => true,
                'message' => 'Loan added successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to save loan.'
            ]);
        }
    }

    public function get_loans()
    {
        $status = $this->input->get('status');

        $this->db->select("
            l.id,
            CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,
            l.borrower_id,
            CONCAT(b.firstname, ' ', b.middlename, ' ', b.lastname) AS fullname,
            l.loan_purpose,
            l.co_maker,
            l.co_maker_contact,
            l.relationship,
            l.collateral,
            l.loan_amount,
            l.interest_rate,
            l.total_balance,
            l.unearned_interest,
            l.loan_plan,
            l.effective_date,
            l.monthly_payment,
            l.date_created,
            l.status
        ");
        $this->db->from('tbl_loan l');
        $this->db->join('tbl_borrower b', 'l.borrower_id = b.id', 'left');

        if (!empty($status)) {
            $this->db->where('l.status', $status);
        }

        $this->db->order_by('l.id', 'ASC');

        $query = $this->db->get();

        echo json_encode([
            'data' => $query->result()
        ]);
    }


    public function update_loan()
    {
        $id = $this->input->post('loan_id');

        $data = [
            'borrower_id'             => $this->input->post('borrower_id'),
            'loan_purpose'            => $this->input->post('loan_purpose'),
            'co_maker'                => $this->input->post('co_maker_name'),
            'co_maker_contact'        => $this->input->post('co_maker_contact'),
            'relationship'            => $this->input->post('relationship'),
            'collateral'              => $this->input->post('collateral'),
            'loan_plan'               => $this->input->post('loan_plan'),
            'effective_date'          => $this->input->post('effective_date'),
            'loan_amount'             => str_replace(',', '', $this->input->post('principal_amount')),
            'interest_rate'           => $this->input->post('interest_rate'),
            'monthly_payment'         => $this->input->post('monthly_payment'),
            'unearned_interest'       => $this->input->post('unearned_interest'),
            'total_balance'           => $this->input->post('total_balance'),

            // Logged-in user
            'updated_by' => $this->session->userdata('id'),

            // Optional: update timestamp
            'date_updated'            => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tbl_loan', $data);

        echo json_encode([
            'status' => $update
        ]);
    }



    public function get_loan_for_details()
    {
        $id = $this->input->post('id');

        $query = $this->db->query("
            SELECT
                l.*,
                CONCAT(b.firstname,' ',b.middlename,' ',b.lastname) AS fullname
            FROM tbl_loan l
            LEFT JOIN tbl_borrower b
                ON b.id = l.borrower_id
            WHERE l.id = '$id'
        ");

        if($query->num_rows() > 0)
        {
            echo json_encode([
                'status' => true,
                'data' => $query->row()
            ]);
        }
        else
        {
            echo json_encode([
                'status' => false
            ]);
        }
    }



    // ===== Payment ======
    public function get_loans_payments()
    {
        $filter = $this->input->get('filter');

        $where = "";

        
        if ($filter == "Pending") {
            $where = "WHERE l.status = 'Pending'";
        } elseif ($filter == "Released") {
           $where = "WHERE l.status = 'Released'";
        } elseif ($filter == "partial") {
            $where = "WHERE l.status = 'Partial'";
        } elseif ($filter == "fully") {
            $where = "WHERE l.status = 'Fully'";
        }

        $query = $this->db->query("
            SELECT 
                l.id,
                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,
                CONCAT(
                    b.firstname, ' ',
                    IFNULL(b.middlename, ''), ' ',
                    b.lastname
                ) AS fullname,
                l.loan_amount,
                l.interest_rate,
                l.effective_date,
                l.total_balance,
                COALESCE(SUM(p.payment_amount), 0) AS total_paid,
                (l.total_balance - COALESCE(SUM(p.payment_amount), 0)) AS remaining_balance,
                l.status
            FROM tbl_loan l
            LEFT JOIN tbl_payment p ON p.loan_id = l.id
            LEFT JOIN tbl_borrower b ON b.id = l.borrower_id
            $where
            GROUP BY 
                l.id,
                l.borrower_id,
                l.loan_amount,
                l.interest_rate,
                l.effective_date,
                l.total_balance,
                l.status,
                b.firstname,
                b.middlename,
                b.lastname
        ");

        echo json_encode([
            "data" => $query->result()
        ]);
    }



    public function get_loan_by_refno()
    {
        $ref_no = trim($this->input->post('ref_no'));
        $payment_date = new DateTime(
            $this->input->post('payment_date') ?: date('Y-m-d')
        );

        $query = $this->db->query("
            SELECT 
                l.id,
                l.borrower_id,
                l.loan_plan,
                l.effective_date,
                CONCAT('RN-', LPAD(l.id, 6, '0')) AS ref_no,

                CONCAT(
                    b.firstname,' ',
                    IFNULL(b.middlename,''),
                    ' ',
                    b.lastname
                ) AS borrower_name,

                CAST(l.loan_amount AS DECIMAL(15,2)) AS loan_amount,
                CAST(l.monthly_payment AS DECIMAL(15,2)) AS monthly_payment,
                CAST(l.total_balance AS DECIMAL(15,2)) AS total_balance,

                COALESCE(
                    SUM(
                        CAST(
                            REPLACE(
                                REPLACE(p.payment_amount, ',', ''),
                                '₱',
                                ''
                            ) AS DECIMAL(15,2)
                        )
                    ),
                0) AS total_overall_paid,

                MAX(p.date_payment) AS last_payment_date

            FROM tbl_loan l
            LEFT JOIN tbl_borrower b ON b.id = l.borrower_id
            LEFT JOIN tbl_payment p ON p.loan_id = l.id

            WHERE CONCAT('RN-', LPAD(l.id, 6, '0')) = ?

            GROUP BY
                l.id,
                l.borrower_id,
                l.effective_date,
                l.loan_amount,
                l.monthly_payment,
                l.total_balance,
                b.firstname,
                b.middlename,
                b.lastname
        ", [$ref_no]);

        $row = $query->row();

        if (!$row) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Reference number not found.'
            ]);
            return;
        }

        // Loan Summary
       
        $loan_amount     = (float)$row->loan_amount;
        $monthly_payment = (float)$row->monthly_payment;
        $total_balance   = (float)$row->total_balance;
        $total_paid      = (float)$row->total_overall_paid;
        $loan_plan       = (int)$row->loan_plan;

        // Remaining Balance
        
        $remaining_balance = round(
            max(0, $total_balance - $total_paid),
            2
        );

        // Paid Cycles Calculation
   
        $paid_cycles = 0;
        $current_month_paid = 0;

        if ($monthly_payment > 0) {

            // Count completed installments
            $paid_cycles = min(
                $loan_plan,
                (int) floor(($total_paid + 0.01) / $monthly_payment)
            );

            // Remaining amount already paid toward current cycle
            $current_month_paid = round(
                $total_paid - ($paid_cycles * $monthly_payment),
                2
            );
        }

        //  Next Due Date
        
        $effective_date = new DateTime($row->effective_date);

        if ($loan_plan > 0 && $paid_cycles >= $loan_plan) {

            // Loan completely paid
            $next_due_date = null;

        } else {

            // Next unpaid cycle due date
            $next_due_date = clone $effective_date;
            $next_due_date->modify("+{$paid_cycles} month");
        }

        // Penalty Calculation
        
        $overdue_cycles = 0;
        $late_days = 0;
        $penalty = 0;

        if ($remaining_balance > 0) {

            $start_date = new DateTime($row->effective_date);

            // Current cycle that should be paid
            $expected_cycles = $paid_cycles + 1;

            for ($i = 0; $i < $expected_cycles; $i++) {

                $due_date = clone $start_date;
                $due_date->modify("+{$i} month");

                // Skip cycles already fully paid
                if ($i < $paid_cycles) {
                    continue;
                }

                // Apply penalty only if overdue
                if ($payment_date > $due_date) {

                    $days_late = $due_date->diff($payment_date)->days;

                    $late_days += $days_late;

                    // ₱1 per day penalty
                    $penalty += $days_late;
                }
            }
        }

        // Amount Due Calculation
        
        $installment_due = 0;

        if ($remaining_balance <= 0) {

            $amount_due = 0;

        } else {

            // Partial payment for current cycle
            if ($current_month_paid > 0) {

                $installment_due = $monthly_payment - $current_month_paid;

            } else {

                $installment_due = $monthly_payment;
            }

            // Final payment adjustment
            if ($remaining_balance < $installment_due) {

                $installment_due = $remaining_balance;
            }

            $amount_due = $installment_due + $penalty;
        }

        $amount_due = round($amount_due, 2);

        //  Loan Status
        
        if ($remaining_balance <= 0.05) {

            $status = 'Fully';
            $remaining_balance = 0;

        } elseif ($total_paid > 0) {

            $status = 'Partial';

        } else {

            $status = 'Released';
        }

        //  Update Loan Status
        
        $this->db->where('id', $row->id);
        $this->db->update('tbl_loan', [
            'status' => $status
        ]);

        //  Return Loan Information
       
        echo json_encode([
            'status' => 'success',
            'data' => [

                'id' => $row->id,
                'borrower_id' => $row->borrower_id,
                'ref_no' => $row->ref_no,
                'borrower_name' => $row->borrower_name,

                'loan_amount' => round($loan_amount, 2),
                'monthly_payment' => round($monthly_payment, 2),
                'total_balance' => round($total_balance, 2),
                'total_overall_paid' => round($total_paid, 2),

                'remaining_balance' => round($remaining_balance, 2),

                'effective_date' => $row->effective_date,
                'last_payment_date' => $row->last_payment_date,

                'next_due_date' => $next_due_date
                    ? $next_due_date->format('Y-m-d')
                    : null,

                'loan_plan' => $loan_plan,
                'paid_cycles' => $paid_cycles,
                'overdue_cycles' => $overdue_cycles,

                'late_days' => $late_days,
                'penalty' => round($penalty, 2),

                'base_amount_due' => round($installment_due, 2),
                'total_amount_due' => round($amount_due, 2),
                'amount_due' => round($amount_due, 2),

                'loan_status' => $status
            ]
        ]);
    }

   public function add_payment()
    {
        date_default_timezone_set('Asia/Manila');

        $loan_id = $this->input->post('loan_id');

        $loan = $this->db
            ->where('id', $loan_id)
            ->get('tbl_loan')
            ->row();

        if (!$loan) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Loan not found.'
            ]);
            return;
        }

        $total_balance = (float)$loan->total_balance;

        $paid = $this->db->query("
            SELECT COALESCE(
                SUM(
                    CAST(
                        REPLACE(
                            REPLACE(payment_amount,'₱',''),
                            ',',
                            ''
                        ) AS DECIMAL(15,2)
                    )
                ),
            0) AS total_paid
            FROM tbl_payment
            WHERE loan_id = ?
        ", [$loan_id])->row();

        $total_paid = (float)$paid->total_paid;

        $remaining_balance = round(
            max(0, $total_balance - $total_paid),
            2
        );

        if ($remaining_balance <= 0.05) {

            $this->db->where('id', $loan_id)->update('tbl_loan', [
                'status' => 'Fully'
            ]);

            echo json_encode([
                'status' => 'error',
                'message' => 'This loan is already fully paid.'
            ]);
            return;
        }

        $payment_amount  = (float)$this->input->post('amount_paid');
        $penalty_amount  = (float)$this->input->post('penalty_amount');

        // TOTAL PAYMENT = amount + penalty
        $total_payment = round($payment_amount + $penalty_amount, 2);

        if ($payment_amount <= 0) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid payment amount.'
            ]);
            return;
        }

        $tolerance = 0.05;

        if ($payment_amount > ($remaining_balance + $tolerance)) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Payment exceeds remaining balance of ₱' .
                    number_format($remaining_balance, 2)
            ]);
            return;
        }

        if (abs($payment_amount - $remaining_balance) <= $tolerance) {
            $payment_amount = $remaining_balance;
        }


        // YYYYMM format
        $ym = date('Ym');

        $count_row = $this->db->query("
            SELECT COUNT(*) as cnt
            FROM tbl_payment
            WHERE ref_no = ?
        ", [$this->input->post('reference_number')])->row();

        $next_seq = (int)$count_row->cnt + 1;

        $payment_no = 'PN-' . $ym . '-' . str_pad($next_seq, 2, '0', STR_PAD_LEFT);


        $insert = [
            'loan_id'        => $loan_id,
            'borrower_id'    => $this->input->post('borrower_id'),
            'ref_no'         => $this->input->post('reference_number'),
            'payment_no'     => $payment_no, 
            'collector'      => $this->session->userdata('fullname'),

            'payment_amount' => $payment_amount,
            'penalty'        => $penalty_amount,
            'total_payment'  => $total_payment,

            'payment_method' => $this->input->post('payment_method'),
            'date_payment'   => date('Y-m-d H:i:s')
        ];

        $this->db->insert('tbl_payment', $insert);

        $paid_after = $this->db->query("
            SELECT COALESCE(
                SUM(
                    CAST(
                        REPLACE(
                            REPLACE(payment_amount,'₱',''),
                            ',',
                            ''
                        ) AS DECIMAL(15,2)
                    )
                ),
            0) AS total_paid
            FROM tbl_payment
            WHERE loan_id = ?
        ", [$loan_id])->row();

        $new_total_paid = (float)$paid_after->total_paid;

        $new_remaining_balance = round(
            max(0, $total_balance - $new_total_paid),
            2
        );

        if ($new_remaining_balance <= 0.05) {

            $loan_status = 'Fully';
            $new_remaining_balance = 0;

        } elseif ($new_total_paid > 0) {

            $loan_status = 'Partial';

        } else {

            $loan_status = 'Released';
        } 

        $this->db->where('id', $loan_id)->update('tbl_loan', [
            'status' => $loan_status
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Payment successfully recorded.',
            'date_payment' => date('Y-m-d H:i:s'),
            'data' => [
                'loan_amount' => round($total_balance, 2),
                'total_overall_paid' => round($new_total_paid, 2),
                'remaining_balance' => round($new_remaining_balance, 2),
                'loan_status' => $loan_status
            ]
        ]);
    }


    public function release_loan()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $success = $this->db->update('tbl_loan', [
            'status' => 'Released'
        ]);

        if ($success) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Loan has been released successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to release loan.'
            ]);
        }
    }

    public function delete_loan()
    {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $success = $this->db->delete('tbl_loan');

        if ($success) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Loan deleted successfully.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete loan.'
            ]);
        }
    }


    public function fetch_the_collectors()
    {
        $collectors = $this->db
            ->order_by('fullname', 'ASC')
            ->get('tbl_collector')
            ->result();

        echo json_encode($collectors);
    }


    public function get_payment_history()
    {
        $loan_id = $this->input->post('loan_id');
        $ref_no  = $this->input->post('ref_no');

        $payments = $this->db->query("
            SELECT 
                p.id,
                p.payment_no,
                p.date_payment,
                p.collector,
                p.payment_method,
                p.payment_amount,
                p.penalty,

                (SELECT COALESCE(SUM(payment_amount),0)
                    FROM tbl_payment
                    WHERE loan_id = p.loan_id) AS total_overall_paid,

                (
                    l.total_balance - 
                    SUM(p.payment_amount) OVER (
                        PARTITION BY p.loan_id 
                        ORDER BY p.date_payment, p.id
                    )
                ) AS remaining_balance

            FROM tbl_payment p
            LEFT JOIN tbl_loan l ON l.id = p.loan_id
            WHERE p.loan_id = '$loan_id'
            ORDER BY p.date_payment, p.id
        ")->result();

        echo json_encode([
            "data" => $payments
        ]);
    }


    public function update_payment()
    {
        $id = $this->input->post('id');

        $payment_amount = str_replace(
            ['₱', ','],
            '',
            $this->input->post('payment_amount')
        );

        $data = [
            'collector'     => $this->session->userdata('fullname'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_amount' => $payment_amount
        ];

        $this->db->where('id', $id);
        $update = $this->db->update('tbl_payment', $data);

        if ($update) {

            $payment = $this->db->select('loan_id')
                ->from('tbl_payment')
                ->where('id', $id)
                ->get()
                ->row();

            if ($payment) {

                $loan_id = $payment->loan_id;

                $total_paid = $this->db->select_sum('payment_amount')
                    ->from('tbl_payment')
                    ->where('loan_id', $loan_id)
                    ->get()
                    ->row()
                    ->payment_amount;

                $loan = $this->db->select('total_balance')
                    ->from('tbl_loan')
                    ->where('id', $loan_id)
                    ->get()
                    ->row();

                $remaining = $loan->total_balance - $total_paid;

                $status = ($remaining <= 0) ? 'Fully' : 'Partial';

                $this->db->where('id', $loan_id);
                $this->db->update('tbl_loan', [
                    'status' => $status
                ]);
            }
        }

        echo json_encode([
            'success' => $update
        ]);
    }



    




}