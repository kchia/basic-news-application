<?php
class News_model extends CI_Model {

  public function __construct()
  {
          $this->load->database();
  }

  public function get_news($slug = FALSE)
  {
  	if($slug === FALSE)
  	{
  		$query = $this->db->get('news');
  		return $query->result_array();
  	}

  	$query = $this->db->get_where('news', array('slug' => $slug));
  	return $query->row_array();
  }

  public function set_news()
  {
  	$this->load->helper('url');

  	// url_title is a helper function that strips down the string, replacing all spaces by dashes(-) and makes sure everything is in lowercase
  	$slug = url_title($this->input->post('title'), 'dash', TRUE);

  	$data = array(
  		'title' => $this->input->post('title'),
  		'slug' => $slug,
  		// post protects from attacks
  		'text' => $this->input->post('text')
  	);

  	return $this->db->insert('news', $data);
  }
}
