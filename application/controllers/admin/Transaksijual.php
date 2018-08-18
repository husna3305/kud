<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksijual extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Barang_model');
		$this->load->model('admin/Suplier_model');
		$this->load->model('admin/Transaction_model');
		$this->load->model('admin/Kategori_model');
		$this->load->model('admin/Kelompok_tani_model');
		$this->load->model('admin/Konsumenpribadi_model');
		$this->load->model('admin/Penyandangdana_model');
		$this->load->model('admin/Kud_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Transaksi Penjualan', 'admin/transaksijual');

		/* Load Menus */
		$this->data['menus'] = $this->Menus_model->get_all();
		$this->data['kud'] = $this->Kud_model->get_all();
		
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();

         $this->load->library("cart");
        $this->load->helper('tgl_indo');
         
		/* Load Library Cart */
         $this->load->library("udp_cart");
         $this->cart1 = new Udp_cart("cart1");
	}

	private function show_menu_check()
	{
		//Cek Show Menu
			$link = $this->router->fetch_class();
			$menu_id =  $this->ion_auth->menu_preferences($link);
			if ( $menu_id == 0 )
			{
				redirect('admin/dashboard', 'refresh');
			}
	}

	private function access_menu()
	{
		//Cek Menu
			$link = $this->router->fetch_class();
			$this->data['menu_id'] =  $this->ion_auth->check_access_menu($link);
	}

	public function index()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth/login', 'refresh');
		}
		else
		{
			$this->show_menu_check();
			$this->access_menu();
			/* Title Page */
			$this->page_title->push('Form Tambah Transaksi Penjualan');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			

			/* Load Template */
			$this->data['kategori'] = $this->Kategori_model->get_all_aktif();
			$this->template->admin_render('admin/transaksijual/index', $this->data);
		}
	}

	public function search_barang()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['barang'] = $this->Barang_model->get_all();
		$this->load->view('admin/transaksijual/content_search_barang',$data);
	  }
	}

	public function search_stokbarang()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['barang'] = $this->Barang_model->get_stok($this->input->post('id_barang'));
		$this->load->view('admin/transaksijual/content_search_stokbarang',$data);
	  }
	}

	public function search_kelompoktani()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['kelompoktani'] = $this->Kelompok_tani_model->get_all_aktif();
		$this->load->view('admin/transaksijual/content_search_kelompoktani',$data);
	  }
	}

	public function search_konsumenpribadi()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['konsumenpribadi'] = $this->Konsumenpribadi_model->get_all_aktif();
		$this->load->view('admin/transaksijual/content_search_konsumenpribadi',$data);
	  }
	}

	public function search_penyandangdana()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['penyandangdana'] = $this->Penyandangdana_model->get_all_aktif();
		$this->load->view('admin/transaksijual/content_search_penyandangdana',$data);
	  }
	}

	public function tampilDaftarTransaksi()
	{
		$this->load->view('admin/transaksijual/content_daftar_transaksi');
	}

	public function tambah_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $id_barang = $this->input->post('id_barang');
         $id_stok = $this->input->post('id_stok');
         $jml_belanja = $this->input->post('jml_belanja');
         $barang = $this->Barang_model->get_by_id($id_barang)->row();
         $harga_jual_tunai= $this->input->post('harga_jual_tunai');
         $harga_jual_angsur= $this->input->post('harga_jual_angsur');
         $kategori = array(0 => $barang->root_kategori, 1=>$barang->nama_kategori );
         $kategori_imp = implode(',', $kategori);
         $data = array(
            'id'        => $id_stok,
            'id_barang'  => $id_barang,
            'qty'       => $jml_belanja,
            'price'     => $harga_jual_tunai,
            'name'      => $barang->nama_barang,
            'kategori'   		=> $kategori_imp,
            'harga_jual_tunai'    => $harga_jual_tunai,
            'harga_jual_angsur'    => $harga_jual_angsur,
            'insentif'    => 0
        );
        $this->cart1->insert($data);
        $this->load->view('admin/transaksijual/content_daftar_transaksi');
      }
    }
/*
    public function update_qty()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $id = $this->input->post('id');
         $qty = $this->input->post('qty');
         
	         if ($cart = $this->cart1->get_content()) {
	         	foreach ($cart as $items){
	         	if ($items['id']== $id) {
	         		$price = $items['price'];
	         		$id_barang = $items['id_barang'];
	         		$name = $items['name'];
	         		$kategori = $items['kategori'];
	         		$harga_jual_tunai = $items['harga_jual_tunai'];
	         		$harga_jual_angsur = $items['harga_jual_angsur'];
	         	}break;
	         } 
         }

          $data = array(
            'id'        => $id,
            'id_barang'  => $id_barang,
            'qty'       => $qty,
            'price'     => $price,
            'name'      => $name,
            'kategori'   		=> $kategori,
            'harga_jual_tunai'    => $harga_jual_tunai,
            'harga_jual_angsur'    => $harga_jual_angsur
        );

        $this->cart1->update($data);
        
        $this->load->view('admin/transaksijual/content_daftar_transaksi');
      }
    } */

    public function hapus_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $rowid = $this->input->post('rowid');
        $this->cart1->remove_item($rowid);
        $this->load->view('admin/transaksijual/content_daftar_transaksi');
      }
    }

    public function hapus_semua_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $this->cart1->destroy();
        $this->load->view('admin/transaksijual/content_daftar_transaksi');
      }
    }

    public function simpanDaftarTransaksi()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	if ($this->cart1->total_articles()==0) {
			$this->session->set_flashdata('err', "Data Barang Belum Dipilih");
        	redirect('admin/transaksijual', 'refresh');
      	}else{
      	$id_kelompok_tani = $this->input->post('id_kelompok_tani');
      	$id_konsumenpribadi = $this->input->post('id_konsumenpribadi');
      	$check_jenispembayaran = $this->input->post('check_jenispembayaran');
      	$check_jenisangsuran = $this->input->post('check_jenisangsuran');
      	$check_pembeli = $this->input->post('check_pembeli');
      	$penambahan_biaya_angsuran_perpembayaran = $this->input->post('penambahan_biaya_angsuran_perpembayaran');
      	$tanggal = $this->input->post('tanggal');
      	$id_penyandangdana = $this->input->post('id_penyandangdana');
		//Mengambil Data Transaksi Terakhir
          $last_transaksi=$this->Transaction_model->get_transaksi_penjualan_header_terakhir($tanggal)->row();
          $dt_expl = explode('-', $tanggal);
          $dt   = implode('', $dt_expl);
          if ($last_transaksi->max_id==null) {
            $last_transaksi_id="TR-JL-$dt-000000";
          }else{
            $last_transaksi_id = $last_transaksi->max_id;
          }

          //Membuat Kode Baru Pembayaran Transaksi
          $last_trans_expl=explode("-", $last_transaksi_id);
          $get_last_trans = $last_trans_expl[3];
          $new_transaksi_id = 'TR-JL-'.$dt.'-'.sprintf("%06d", $get_last_trans+1);
          $count_barang=0;

          // Cek Jenis Pembeli
          	if ($check_pembeli=='true') {
          		$jenis_pembeli = 'kelompoktani';
          		$nama_pembeli = $this->Kelompok_tani_model->get_by_id_aktif($id_kelompok_tani)->row()->nama_kelompok_tani;
          	}else{
          		$jenis_pembeli = 'pribadi';
          		$nama_pembeli = $this->Konsumenpribadi_model->get_by_id_aktif($id_konsumenpribadi)->row()->nama_konsumenpribadi;
          	}
          // Cek Jenis Pembayaran
          	if ($check_jenispembayaran=='true') {
          		$jenis_pembayaran = 'tunai';
          		$jenis_angsuran = '';
          	}else{
          		$jenis_pembayaran = 'angsur';
          		if ($check_jenisangsuran =='true'){
          			$jenis_angsuran = 'per_pembayaran';
          		}elseif ($check_jenisangsuran=='false') {
          			$jenis_angsuran = 'per_barang';
          		}
          	}

          if ($this->cart1->get_content()) {
          		$total_pembayaran_angsur=0;
          		$subtotal_angsuran=0;
	          foreach ($this->cart1->get_content() as $items) {
	          	$data_transaction['transaksi_detail'][$count_barang]=array('id_transaksi_penjualan' => $new_transaksi_id, 
	          									'id_barang' => $items['id_barang'],
	          									'qty' => $items['qty'],
	          									'harga_jual_angsur' => $items['harga_jual_angsur'],
	          									'harga_jual_tunai' => $items['harga_jual_tunai'],
								   				'user_id-add' => $this->ion_auth->user()->row()->id,
								   				'date_created' => date('Y-m-d G:i:s')
	          							  );
	              $data_transaction['stok_barang'][$count_barang]=array('keterangan_transaksi' =>$new_transaksi_id, 
          									'id_barang' => $items['id_barang'],
          									'keluar' => $items['qty'],
          									'id_stok_dikeluarkan' => $items['id'],
          									'keterangan' => 'Transaksi Penjualan Barang, Dibeli Oleh '.$nama_pembeli,
          									'tanggal' => $tanggal,          								  
          								  	'waktu' => date('G:i:s'),
							   				'user_id-add' => $this->ion_auth->user()->row()->id,
							   				'date_created' => date('Y-m-d G:i:s')
          							  );

	          	$count_barang++;
	          	if ($jenis_angsuran=='per_barang') {
	          		$subtotal_angsuran = $items['qty'] * $items['harga_jual_angsur'];
	          		$total_pembayaran_angsur = $total_pembayaran_angsur + $subtotal_angsuran;
	          	}
	          }
	          if ($jenis_angsuran=='per_pembayaran') {
	          	$total_pembayaran_angsur = $this->cart1->total_cart() + $penambahan_biaya_angsuran_perpembayaran;
	          }
	          $tgl_transaksi = $tanggal;
	          $data_transaction['transaksi_header'][0]=array('id_transaksi_penjualan' => $new_transaksi_id,
	          								  'konsumen_pribadi' => $id_konsumenpribadi,
	          								  'kelompoktani' => $id_kelompok_tani,
	          								  'id_penyandangdana' => $id_penyandangdana,
	          								  'jenis_pembayaran' => $jenis_pembayaran,
	          								  'jenis_pembeli' => $jenis_pembeli,
	          								  'jenis_angsuran' => $jenis_angsuran,
	          								  'penambahan_biaya_angsuran_perpembayaran' => $penambahan_biaya_angsuran_perpembayaran,
	          								  'total_pembayaran_tunai' => $this->cart1->total_cart(),
	          								  'total_pembayaran_angsur' => $total_pembayaran_angsur,
	          								  'tanggal' => $tanggal,          								
	          								  'waktu' => date('G:i:s'),
								   			  'user_id-add' => $this->ion_auth->user()->row()->id,
								   			  'date_created' => date('Y-m-d G:i:s')
	          						    );
			
	      }
  
      if ($this->Transaction_model->create_transaction_penjualan($data_transaction)) {
        $this->cart1->destroy();
        $data['transaksi_header'] = $this->Transaction_model->get_transaksi_penjualan_header($new_transaksi_id)->row();
      	$data['transaksi_detail'] = $this->Transaction_model->get_transaksi_penjualan_detail_by_idtransaksipenjualan($new_transaksi_id)->result();
		$this->load->view('admin/transaksijual/content_nota_sukses',$data);
        } 
      else{
		$this->session->set_flashdata('err', "Data Gagal Ditambah");
      	}
      	}
	  }
	}




	public function sukses($id_transaksi=null)
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->breadcrumbs->unshift(2, 'Create', 'admin/kelompoktani/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('&nbsp;');
		$this->data['pagetitle'] = $this->page_title->show();
      		//$last_transaksi_id = 'TR-JL-20180722-000003';
      		$this->data['transaksi_header'] = $this->Transaction_model->get_transaksi_penjualan_header($id_transaksi)->row();
      	$this->data['transaksi_detail'] = $this->Transaction_model->get_transaksi_penjualan_detail_by_idtransaksipenjualan($id_transaksi)->result();
			$this->template->admin_render('admin/transaksijual/content_nota_sukses', $this->data);

      }
	}


	public function create()
	{
		/* Cek Menu Show */
		$this->show_menu_check();
		/* Breadcrumbs */
		$this->breadcrumbs->unshift(2, 'Create', 'admin/kelompoktani/create');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		$this->page_title->push('&nbsp;');
		$this->data['pagetitle'] = $this->page_title->show();

		if ($this->input->post('nama_kelompok_tani')) {
			if ( !$this->input->post('aktif') )
			{
				$aktif = '0';
			}else{
				$aktif = '1';
			}
			$data[1] = array(
							   'nama_kelompok_tani' => $this->input->post('nama_kelompok_tani'),
							   'alamat' => $this->input->post('alamat'),
							   'no_telp' => $this->input->post('no_telp'),
							   'aktif' => $aktif,
							   'user_id-add' => $this->ion_auth->user()->row()->id,
							   'date_created' => date('Y-m-d G:i:s')
							   );
		
		   	if($this->Kelompok_tani_model->create($data))
			{
			  $this->session->set_flashdata('true', 'Data Berhasil Ditambah');
			  redirect('admin/kelompoktani', 'refresh');
			}
			else
			{
			  $this->session->set_flashdata('err', "Data Gagal Ditambah");
			}
		}

		else
		{
			/* Load Template */
			$this->template->admin_render('admin/kelompok_tani/create', $this->data);
		}
	}




	public function update($id)
	{
		/* Cek Menu Show */
			$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		/* Breadcrumbs */

		$this->data['pagetitle'] = 'Form Update Data Kelompok Tani';
		$this->breadcrumbs->unshift(2, 'Update', 'admin/kelompoktani/edit');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();

		if (isset($_POST) && ! empty($_POST))
		{
			
			if ($this->input->post('nama_kelompok_tani') == TRUE)
			{
				if ( !$this->input->post('aktif') )
				{
					$aktif = '0';
				}else{
					$aktif = '1';
				}
				$data[1] = array(
							   'id_kelompok_tani' => $this->input->post('id_kelompok_tani'),
							   'nama_kelompok_tani' => $this->input->post('nama_kelompok_tani'),
							   'alamat' => $this->input->post('alamat'),
							   'no_telp' => $this->input->post('no_telp'),
							   'aktif' => $aktif,
							   'user_id-upd' => $this->ion_auth->user()->row()->id,
							   'last_updated' => date('Y-m-d G:i:s')
							   );
			   	if($this->Kelompok_tani_model->update($data))
				{
				  $this->session->set_flashdata('true', 'Data Berhasil Di Ubah');
				  redirect('admin/kelompoktani', 'refresh');
				}
				else
				{
				  $this->session->set_flashdata('err', "Data Gagal Di Ubah");
				}
			} 
		}else{
		//Get One Data To Edit
		$this->data['kelompoktani']  = $this->Kelompok_tani_model->get_by_id($id)->row();
		/* Load Template */
		$this->template->admin_render('admin/kelompok_tani/update', $this->data);
		}
	}

	public function setStatus()
	{
		/* Cek Menu Show */
		$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
			if ( $this->input->post('aktif') == 0 )
			{
				$aktif = 1;
			}else{
				$aktif = 0;
			}
			$this->data_update[1] = array(
					   'id_kelompok_tani' => $this->input->post('id_kelompok_tani'),
					   'aktif' => $aktif,
					   'user_id-upd' => $this->ion_auth->user()->row()->id,
					   'last_updated' => date('Y-m-d G:i:s')
			);

			if($this->Kelompok_tani_model->update($this->data_update))
			{
				$this->session->set_flashdata('true', 'Status Berhasil Diedit');
			}
	}

	public function setDelete()
	{
		/* Cek Menu Show */
		$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
		$this->show_menu_check();
		if ( $this->input->post('deleted_status') == 0 )
		{
			$deleted_status = 1;
		}else{
			$deleted_status = 0;
		}
		$this->data_del[1] = array(
				   'id_kelompok_tani' => $this->input->post('id_kelompok_tani'),
				   'deleted_status' => $deleted_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);

		if($this->Kelompok_tani_model->update($this->data_del))
		{
			$this->session->set_flashdata('true', 'Proses Berhasil');
		}
	}

	public function delete_permanen()
	{
		/* Cek Menu Show */
		$this->show_menu_check();

		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}
			$this->show_menu_check();
		
		$id_kelompok_tani['id_kelompok_tani']=$this->input->post('id_kelompok_tani');
		if($this->Kelompok_tani_model->delete($id_kelompok_tani))
		{
			$this->session->set_flashdata('true', 'Data Berhasil Dihapus Permanen');
		} 
	}

	public function daftartransaksi()
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->show_menu_check();
		$this->access_menu();
      	$this->breadcrumbs->unshift(2, 'Create', 'admin/belanjabarang/daftartransaksi');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->page_title->push('Daftar Transaksi Penjualan Barang');
		$this->data['pagetitle'] = $this->page_title->show();
      	$this->data['transaksi_header'] = $this->Transaction_model->get_all_transaksi_penjualan_header()->result();
		$this->template->admin_render('admin/transaksijual/daftar_semua', $this->data);
      }
	}

	public function bykelompoktani()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}else{
			$this->show_menu_check();
			$this->access_menu();
	      	$this->breadcrumbs->unshift(2, 'Create', 'admin/transaksijual/bykelompoktani');
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			$this->page_title->push('Daftar Transaksi Penjualan Barang');
			$this->data['pagetitle'] = $this->page_title->show();
	      	$this->data['bykelompoktani'] = $this->Transaction_model->get_all_transaksi_penjualan_header_bykelompoktani()->result();
			$this->template->admin_render('admin/transaksijual/daftar_bykelompoktani', $this->data);
		}
	}

	public function bykelompoktanidetail($id_kelompok_tani=null)
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->show_menu_check();
		$this->access_menu();
      	$this->breadcrumbs->unshift(2, 'Create', 'admin/transaksijual/bykelompoktani');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->page_title->push('Daftar Transaksi Penjualan Barang');
		$this->data['pagetitle'] = $this->page_title->show();
		$this->template->admin_render('admin/transaksijual/daftar_bykelompoktanidetail', $this->data);
      }
	}

	public function bykelompoktanidetail_cetak($kelompoktani=null,$tgl_mulai=null,$tgl_selesai=null)
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $data_perpage['tgl_mulai'] = $tgl_mulai;
        $data_perpage['tgl_selesai'] = $tgl_selesai;
        $data_perpage['kud'] = $this->Kud_model->get_all();
      	$multi_id_transaksi = $this->Transaction_model->get_multi_id_transaksi_penjualan_bykelompoktani($kelompoktani,$tgl_mulai,$tgl_selesai)->row();
      	$bykelompoktani = $this->Transaction_model->get_transaksi_penjualan_detail_multi_id_transaksi($multi_id_transaksi->id_trans);
      	$header= $this->Transaction_model->get_by_kelompoktani_transaksi_penjualan_header($kelompoktani,$tgl_mulai,$tgl_selesai);
      	foreach ($header->result() as $v) {
      		echo "$v->id_kelompok";
      		echo "</br>";
      	}
        // Jika Data Kosong
         $count_header = count($header->result_array());
         $count_detail_bysuplier = count($bysuplier->result_array());
        // End Of Jika Data Kosong

        if ($count_header > 0) {
          foreach ($header->result() as $key_header => $v_header) {
          $data['header'][$key_header] =array('id_transaksi_belanja' => $v_header->id_transaksi_belanja,
                            'id_suplier' => $v_header->id_suplier,
                            'tanggal' => $v_header->tanggal,                            
                            'waktu' => $v_header->waktu,
                            'nama_suplier' => $v_header->nama_suplier,
                            'alamat' => $v_header->alamat,
                            'no_telp' => $v_header->no_telp,
                            'total_pembayaran' => $v_header->total_pembayaran,
                            'count_detail' =>$v_header->count_detail
                             );
          }
        }
        if ($count_detail_bysuplier > 0 ) {
          $val=1;
          foreach ($bysuplier->result_array() as $key => $v_detail) {

            $data['detail'][$key+1]=array('id_transaksi_belanja' => $v_detail['id_transaksi_belanja'],
                              'id_detail' =>$v_detail['id_detail'],
                              'id_barang' =>$v_detail['id_barang'],
                              'nama_barang' =>$v_detail['nama_barang'],
                              'qty' =>$v_detail['qty'],
                              'harga_beli' =>$v_detail['harga_beli'],
                              'harga_jual_tunai' =>$v_detail['harga_jual_tunai'],
                              'harga_jual_angsur' =>$v_detail['harga_jual_angsur'],
                              'total' => $v_detail['qty']*$v_detail['harga_beli']
                        );
            $val++;
          }
        }


      	if ( $count_header > 0) {
          // Menentukan Header Setiap Transaksi
          $d=0;
          for ($i=0; $i < count($data['header']); $i++) { 
             $x = $val+$d;
            $data['detail'][$x]=array
              ('id_transaksi_belanja'=>$data['header'][$i]['id_transaksi_belanja'],
                        'id_detail' =>'',
                        'id_barang' =>'',
                        'qty' =>'',
                        'harga_beli' =>'' ,
                        'harga_jual_tunai' =>'',
                        'harga_jual_angsur' =>'',
                        'total' => $data['header'][$i]['total_pembayaran'],
                        'count_detail' =>$data['header'][$i]['count_detail'],
                        'tanggal' =>$data['header'][$i]['tanggal'],
                        'waktu' =>$data['header'][$i]['waktu'],
                        'nama_suplier' =>$data['header'][$i]['nama_suplier'],
                    );
            $d++;
          }
          // Menentukan Judul Setiap Detail Transaksi
          $count_detail_new = count($data['detail']);
        }
      	if ($count_header > 0 ) {
          $d=1;
          for ($i=0; $i < count($data['header']); $i++) { 
            $x = $count_detail_new+$d;
            $data['detail'][$x]=array
              ('id_transaksi_belanja'=>$data['header'][$i]['id_transaksi_belanja'],
                        'id_detail' =>'x',
                        'id_barang' =>'',
                        'qty' =>'',
                        'harga_beli' =>'' ,
                        'harga_jual_tunai' =>'',
                        'harga_jual_angsur' =>'',
                        'total' => $data['header'][$i]['total_pembayaran'],
                        'count_detail' =>$data['header'][$i]['count_detail'],
                    );
             $d++;
          }

        // Menentukan Footer Setiap Transaksi
        $count_detail_new = count($data['detail']);

        $d=1;
        for ($i=0; $i < count($data['header']); $i++) { 
          $x = $count_detail_new+$d;
          $data['detail'][$x]=array
            ('id_transaksi_belanja'=>$data['header'][$i]['id_transaksi_belanja'],
                      'id_detail' =>'%',
                      'id_barang' =>'',
                      'qty' =>'',
                      'harga_beli' =>'' ,
                      'harga_jual_tunai' =>'',
                      'harga_jual_angsur' =>'',
                      'total' => $data['header'][$i]['total_pembayaran'],
                      'count_detail' =>$data['header'][$i]['count_detail'],
                  );
      $d++;
        }

        }
      	
 
		//array_multisort(array_column($data['detail'], 'id_transaksi_belanja'), SORT_DESC,SORT_NUMERIC,$data['detail']);
		

		if ($count_detail_bysuplier > 0) {
      array_multisort(
      array_column($data['detail'], 'id_transaksi_belanja'), SORT_DESC,
      array_column($data['detail'], 'id_detail'), SORT_ASC,
      $data['detail']);
    }
		//var_dump($data['detail']);
/*
		//ISeng
		unset($data['detail']);
		for ($i=0; $i <106; $i++) { 
			$data['detail'][$i]=array
						('id_transaksi_belanja'=>$i,
											'id_detail' =>'x',
											'id_barang' =>'x',
											'qty' =>'',
											'harga_beli' =>'' ,
											'harga_jual_tunai' =>'',
											'harga_jual_angsur' =>'',
											'total' => '',
											'count_detail' =>'',
									);
		}
		
	//	var_dump($data['detail']);
      	
		/* DEFAULT VALUE
      	$maks_baris_perhalaman_h_f = 31;
      	$maks_baris_perhalaman_h = 36;
      	$maks_baris_perhalaman_f = 38;
      	$maks_baris_perhalaman = 43;
      	*/
      //	var_dump($data['detail']);
      	$maks_baris_perhalaman_h_f = 28;
      	$maks_baris_perhalaman_h = 33;
      	$maks_baris_perhalaman_f = 38;
      	$maks_baris_perhalaman = 44;
      	$page=1;

        if ($count_detail_bysuplier > 0 and $count_header > 0) {
          
          $jml_row_total_krg = count($data['detail']);

        	while ($jml_row_total_krg > 0) {
        		if ($page == 1) {
        			
        			//Jika Jml Data <= maks baris perhalaman dengan header & footer
        			if ($jml_row_total_krg <= $maks_baris_perhalaman_h_f) {
        				//Perulangan Data Disimpan ke array data perpage
        				for ($i=0; $i < $jml_row_total_krg; $i++) { 
        					//echo $page.'/'.$i.'/';
        					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
        					$count[$i]= $i;
        				}
        				$jml_row_total_krg=0;
        			}

        			elseif ($jml_row_total_krg > $maks_baris_perhalaman_h_f) {
        				//Jika Jml Data <= maks baris perhalaman dengan header saja
  	      			if ($jml_row_total_krg <= $maks_baris_perhalaman_h) {
  	      				// Jika jml data < maks baris perhalaman dengan header saja
  	      				if ($jml_row_total_krg < $maks_baris_perhalaman_h ) {
  	      					$row_detail_now = $maks_baris_perhalaman_h_f;
  	      				// Jika jml data < maks baris perhalaman dengan header saja
  	      				}
  	      				elseif ($jml_row_total_krg == $maks_baris_perhalaman_h ) {
  	      					$row_detail_now = $maks_baris_perhalaman_h_f;
  	      				}
  	      				// Jika jml data >= maks baris perhalaman dengan header saja
  	      				elseif ($jml_row_total_krg > $maks_baris_perhalaman_h) {
  	      					$row_detail_now = $maks_baris_perhalaman_h;
  	      				}

  	      				//Perulangan Data Disimpan ke array data perpage
  	      				for ($i=0; $i < $row_detail_now; $i++) { 
  	      					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
  	      					$count[$i] = $i;
  	      					//echo $page.'+'.$i.'+';
  	      				}

  	      				//Pengecekan Untuk Mengurangi Jumlah Baris Yang Sudah Disimpan Ke Array Data Perpage
  	      				if ($jml_row_total_krg < $maks_baris_perhalaman_h) {
  	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
  	      				}
  	      				if ($jml_row_total_krg == $maks_baris_perhalaman_h) {
  	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
  	      				}
  	      				elseif ($jml_row_total_krg >= $maks_baris_perhalaman) {
  	      					$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman;
  	      				}
  	      				$page++;
  	      			}

  	      			elseif ($jml_row_total_krg > $maks_baris_perhalaman_h) {
  	      				for ($i=0; $i < $maks_baris_perhalaman_h; $i++) { 
  	      					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
  	      					$count[$i] = $i;
  	      					//echo $page.'xx'.$i.'xx';
  	      				}
  	      				$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman_h;
  	      				//echo 'jmlxx'.$jml_row_total_krg;
  	      				$page++;
  	      			}
        			}
        			
        		//	echo count($data_perpage['detail_perpage'][$page]);
        			
        		}

        		if ($page>1) {
        			
        			if ($jml_row_total_krg <= $maks_baris_perhalaman_f) {
        				$c = count($count);
        				if ($jml_row_total_krg < $maks_baris_perhalaman_f) {
        					$row_detail_now = $jml_row_total_krg;
        				}
        				elseif ($jml_row_total_krg == $maks_baris_perhalaman_f) {
        					$row_detail_now = $maks_baris_perhalaman_f;
        				}
        				
        				for ($i=$c; $i < ($c+($row_detail_now)); $i++) {
        					$count[$i]=$i;
        					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
        					//echo $page.'%'.$i.'%';
        				}

        				//Pengecekan Untuk Mengurangi Jumlah Baris Yang Sudah Disimpan Ke Array Data Perpage
  	      				if ($jml_row_total_krg < $maks_baris_perhalaman_f) {
  	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
  	      				}
  	      				if ($jml_row_total_krg == $maks_baris_perhalaman_f) {
  	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
  	      				}
  	      				elseif ($jml_row_total_krg >= $maks_baris_perhalaman) {
  	      					$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman;
  	      				}
  	      				$page++;
        			}

        			elseif ($jml_row_total_krg > $maks_baris_perhalaman_f) {
        				
        				if ($jml_row_total_krg <= $maks_baris_perhalaman) {
        					
  	      				$c = count($count);
  	      				if ($jml_row_total_krg < $maks_baris_perhalaman) {
  	      					$row_detail_now = $maks_baris_perhalaman_f;
  	      				}
  	      				elseif ($jml_row_total_krg == $maks_baris_perhalaman) {
  	      					$row_detail_now = $maks_baris_perhalaman_f;
  	      				}
  	      				$row_detail_now;
  	      				/*
  		      				if ( $jml_row_total_krg <= (count($data['detail']) - $c)) {
  		      					$row_detail_now = count($data['detail']) - $c;
  		      				}else{
  		      					$row_detail_now = $maks_baris_perhalaman-1;
  		      				}
  */
    	      				for ($i=$c; $i < ($c+($row_detail_now)); $i++) {
    	      					$count[$i]=$i;
    	      					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
    	      					//echo $page.'&'.$i.'&';
    	      				}

    	      				//Pengecekan Untuk Mengurangi Jumlah Baris Yang Sudah Disimpan Ke Array Data Perpage
    	      				if ($jml_row_total_krg < $maks_baris_perhalaman) {
    	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
    	      				}
    	      				if ($jml_row_total_krg == $maks_baris_perhalaman) {
    	      					$jml_row_total_krg=$jml_row_total_krg -(count($data_perpage['detail_perpage'][$page]));
    	      				}
    	      				elseif ($jml_row_total_krg > $maks_baris_perhalaman) {
    	      					$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman;
    	      				}
    	      				/*
    	      				if ($jml_row_total_krg <= $maks_baris_perhalaman ) {
    	      					$jml_row_total_krg=0;
    	      				}elseif ($jml_row_total_krg > $maks_baris_perhalaman) {
    	      					$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman;
    	      				}    
    	      				*/			
    	      				$page++;

    	      			}

          			elseif ($jml_row_total_krg > $maks_baris_perhalaman) {
          				$c = count($count);
          				for ($i=$c; $i < ($c+($maks_baris_perhalaman)); $i++) {
          					$count[$i]=$i;
          					$data_perpage['detail_perpage'][$page][$i] = $data['detail'][$i];
          					//echo $page.'&'.$i.'&';
          				}
          				$jml_row_total_krg=$jml_row_total_krg-$maks_baris_perhalaman;
          				$page++;
          			}
          			}
          		} 
          	}
        $data_perpage['header'] = $data['header'];
      }
     	//exit; 
      if ($count_detail_bysuplier==0 and $count_header == 0) {
        $data_perpage['empty'] ='y';
      }else{
        $data_perpage['empty'] ='n';
      }
		  $this->load->view('admin/belanjabarang/content_daftar_bysuplierdetail', $data_perpage);
		//exit;
      }
	}

  public function bybarang()
  {
    if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $this->show_menu_check();
    $this->access_menu();
        $this->breadcrumbs->unshift(2, 'Create', 'admin/belanjabarang/bybarang');
    $this->data['breadcrumb'] = $this->breadcrumbs->show();
    $this->page_title->push('Daftar Transaksi Belanja Barang');
    $this->data['pagetitle'] = $this->page_title->show();
        $this->data['bybarang'] = $this->Transaction_model->get_all_transaksi_belanja_bybarang()->result();
    $this->template->admin_render('admin/belanjabarang/daftar_bybarang', $this->data);
      }
  }

  public function tambahKonsumenPribadi()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$this->load->view('admin/transaksijual/content_tambahKonsumenPribadi');
		//exit;
	  }
	}
}
