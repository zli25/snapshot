<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model("test_model");
        $data = $this->test_model->get_summary();
        $this->load->view("summary", $data);
	}

    public function download()
    {
        $this->load->dbutil();
        $this->load->helper('download');

        $query = $this->db->query("SELECT img_base,x1,y1,x2,y2,mark_date,user,series_no FROM Boundingbox");
        $delimiter = ",";
        $csv_data = $this->dbutil->csv_from_result($query, $delimiter);
        $csv_data = str_replace('"', "", $csv_data);
        $csv_data = preg_replace("/,\n/", "\n", $csv_data);     // remove the trailing "," - a bug, see: http://ellislab.com/forums/viewthread/228656/
        
        date_default_timezone_set('America/New_York');
        $date = date('Y_m_d');
        $csv_filename = "boundingbox_$date.csv";

        force_download($csv_filename, $csv_data);
    }
}
?>
