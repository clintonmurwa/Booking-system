<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->database();// Load the database library
        $this->load->model('slots_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pdf'); // Load your PDF library (e.g., TCPDF)
        $this->load->library('email');  // Load the email library


        // Ensure the user is logged in as admin
        // Ensure the user is logged in and has the 'admin' role
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('user/login');
        }
    }

    public function dashboard() {
       
        $this->load->view('admin/dashboard');
    }
    public function view_all() {
        $data['slots'] = $this->slots_model->getAllSlots();
       
        $this->load->model('Bookings_model'); 

        // Fetch the bookings from the model
        $data['bookings'] = $this->Bookings_model->get_all_bookings();
        $this->load->view('admin/view_all.php', $data);
    }
    public function view_slots() {
        $data['slots'] = $this->slots_model->getAllSlots();
       
        $this->load->model('Bookings_model'); 

        // Fetch the bookings from the model
        $data['bookings'] = $this->Bookings_model->get_all_bookings();
        $this->load->view('admin/view_slots', $data);
    }
    public function bookings() {
        $data['slots'] = $this->slots_model->getAllSlots();
       
        $this->load->model('Bookings_model'); 

        // Fetch the bookings from the model
        $data['bookings'] = $this->Bookings_model->get_all_bookings();
        $this->load->view('admin/bookings', $data);
    }
    public function report() {
       
        
       
        $this->load->view('admin/report');
    }
    public function add_slot() {
        $this->form_validation->set_rules('slot_number', 'Slot Number', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/add_slot');
        } else {

            $creator_name = $this->session->userdata('username');

            $data = array(
                'slot_number' => $this->input->post('slot_number'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
                'created_by' => $creator_name,
            );

            $this->slots_model->addSlot($data);
            $this->session->set_flashdata('message', 'Slot added successfully');
            redirect('admin/view_slots');
        }
    }

    public function edit_slot($id) {
        $data['slot'] = $this->slots_model->getSlotById($id);

        $this->form_validation->set_rules('slot_number', 'Slot Number', 'required');
        $this->form_validation->set_rules('start_time', 'Start Time', 'required');
        $this->form_validation->set_rules('end_time', 'End Time', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/edit_slot', $data);
        } else {
            $update_data = array(

                'slot_number' => $this->input->post('slot_number'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
            );

            $this->slots_model->updateSlot($id, $update_data);
            $this->session->set_flashdata('message', 'Slot updated successfully');
            redirect('admin/view_slots');
        }
    }

    public function delete_slot($id) {
        $this->slots_model->deleteSlot($id);
        $this->session->set_flashdata('message', 'Slot deleted successfully');
        redirect('admin/view_slots');
    }

    // Method to send the slots report via email
    public function send_slots_report() {
        // Fetch all slots
        $slots = $this->slots_model->getAllSlots();

        // Generate PDF
        $this->load->library('pdf');
        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Admin');
        $pdf->SetTitle('Available Slots Report');
        $pdf->SetSubject('Slots Report');
        $pdf->SetKeywords('Slots, Report, Admin');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'Available Slots Report', '', array(0,0,0), array(0,0,0));

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
         $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins with proper numeric values
        $pdf->SetMargins(15, 27, 15); // Adjust these margins as needed
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Set image scale factor
        $pdf->setImageScale(1.25);

        // Add a page
        $pdf->AddPage();

        // Title
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Available Slots Report', 0, 1, 'C');

        // Table headers
        $html = '
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>Slot Number</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>';

        // Table data
        foreach ($slots as $slot) {
            $html .= '<tr>
                        <td>' . $slot['slot_number'] . '</td>
                        <td>' . $slot['start_time'] . '</td>
                        <td>' . $slot['end_time'] . '</td>
                      </tr>';
        }

        $html .= '</tbody>
        </table>';

        // Output the HTML content
        $pdf->SetFont('helvetica', '', 12);
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document as a string
        $pdf_content = $pdf->Output('slots_report.pdf', 'S'); // S = Return the document as a string

        // Get email from POST
        $email = $this->input->post('email');

        // Email configuration
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_crypto' => 'ssl',
            'smtp_user' => 'cmurwanthi05@gmail.com', // replace with your email
            'smtp_pass' => 'luozdqaknfioztwy', // replace with your email password or app password
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );

        // Initialize email
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        // Set email parameters
        $this->email->from('cmurwanthi05@gmail.com', 'Admin'); // Change to your email and name
        $this->email->to($email);
        $this->email->subject('Available Slots Report');
        $this->email->message('Attached is the report of all available slots.');

        // Attach PDF
        $this->email->attach($pdf_content, 'attachment', 'slots_report.pdf', 'application/pdf');

        // Send email
        if ($this->email->send()) {
            $this->session->set_flashdata('message', 'Report sent successfully to ' . $email);
        } else {
            $this->session->set_flashdata('message', 'Failed to send report. ' . $this->email->print_debugger());
        }

        // Redirect back to the slots view
        redirect('admin/view_slots');
    }
}
