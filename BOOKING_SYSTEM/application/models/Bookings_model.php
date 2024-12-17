<?php
class Bookings_model extends CI_Model {

    // Create a new booking
       // Insert a new booking with service and comment
       public function create_booking($booking_data) {
        // Insert the booking data directly
        $this->db->insert('bookings', $booking_data);
        return $this->db->insert_id(); // Return the ID of the inserted booking
    }
    

    // Get bookings by user ID
    public function get_bookings_by_user($user_id) {
        $this->db->select('bookings.*, slots.start_time, slots.end_time');
        $this->db->from('bookings');
        $this->db->join('slots', 'bookings.slot_id = slots.id');
        $this->db->where('bookings.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

     public function get_all_bookings() {
        // Fetch all bookings from the 'bookings' table
        $this->db->select('bookings.*, user_details.full_name,user_details.contact_number,user_details.nationality ,user_details.medical_conditions');
        $this->db->from('bookings');
        $this->db->join('user_details', 'bookings.user_id = user_details.user_id', 'left');
        $this->db->order_by('bookings.booking_date', 'DESC');
        $query = $this->db->get();
    
        return $query->result();  // Return the result as an array of objects
    }
}
