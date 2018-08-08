<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class belanjabarang extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Load :: Common */
		$this->load->model('admin/Menus_model');
		$this->load->model('admin/Menus_preferences_model');
		$this->load->model('admin/Barang_model');
		$this->load->model('admin/Suplier_model');
    $this->load->model('admin/Transaction_model');
		$this->load->model('admin/Kud_model');

		/* Breadcrumbs :: Common */
		$this->breadcrumbs->unshift(1, 'Transaksi Belanja Barang', 'admin/belanjabarang');

		/* Load Menus */
    $this->data['menus'] = $this->Menus_model->get_all();
		$this->data['kud'] = $this->Kud_model->get_all();
		$this->data['menus_prefs'] = $this->Menus_preferences_model->get_all()->result();

		/* Load Library Cart */
        $this->load->library('cart');
        $this->load->helper('tgl_indo');
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
			$this->page_title->push('Transaksi Belanja Barang');
			$this->data['pagetitle'] = $this->page_title->show();

			/* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			

			/* Load Template */
			$this->template->admin_render('admin/belanjabarang/index', $this->data);
		}
	}

	public function search_barang()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['barang'] = $this->Barang_model->get_all();
		$this->load->view('admin/belanjabarang/content_search_barang',$data);
	  }
	}

	public function search_suplier()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
		$data['suplier'] = $this->Suplier_model->get_all_aktif();
		$this->load->view('admin/belanjabarang/content_search_suplier',$data);
	  }
	}

	public function tampilDaftarBelanja()
	{
		$this->load->view('admin/belanjabarang/content_daftar_belanja');
	}

	public function tambah_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $id_barang = $this->input->post('id_barang');
         $jml_belanja = $this->input->post('jml_belanja');
         $barang = $this->Barang_model->get_by_id($id_barang)->row();
         $harga_beli= $this->input->post('harga_beli');
         $harga_jual_tunai= $this->input->post('harga_jual_tunai');
         $harga_jual_angsur= $this->input->post('harga_jual_angsur');
         $kategori = array(0 => $barang->root_kategori, 1=>$barang->nama_kategori );
         $kategori_imp = implode(',', $kategori);
         $data = array(
            'id'        => 'brg-'.$id_barang,
            'id_barang'  => $id_barang,
            'qty'       => $jml_belanja,
            'price'     => $harga_beli,
            'name'      => $barang->nama_barang,
            'kategori'   		=> $kategori_imp,
            'harga_beli'    => $harga_beli,
            'harga_jual_tunai'    => $harga_jual_tunai,
            'harga_jual_angsur'    => $harga_jual_angsur
        );
        $this->cart->insert($data);
        $this->load->view('admin/belanjabarang/content_daftar_belanja');
      }
    }

    public function update_qty()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $rowid = $this->input->post('rowid');
         $qty = $this->input->post('qty');
         $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );
        $this->cart->update($data);
        $this->load->view('admin/belanjabarang/content_daftar_belanja');
      }
    }

    public function hapus_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
         $rowid = $this->input->post('rowid');
         $data = array(
            'rowid'        => $rowid,
            'qty'       => 0
        );
        $this->cart->update($data);
        $this->load->view('admin/belanjabarang/content_daftar_belanja');
      }
    }

    public function hapus_semua_barang()
    {
      if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $this->cart->destroy();
        $this->load->view('admin/belanjabarang/content_daftar_belanja');
      }
    }

    public function simpanDaftarBelanja()
	{
		if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	if ($this->cart->total()==0) {
			$this->session->set_flashdata('err', "Data Barang Belum Dipilih");
        	redirect('admin/belanjabarang', 'refresh');
      	}else{
      		$id_suplier = $this->input->post('id_suplier');
      	$tanggal = $this->input->post('tanggal');
		//Mengambil Data Transaksi Terakhir
          $last_transaksi=$this->Transaction_model->get_transaksi_belanja_header_terakhir($tanggal)->row();
          $dt_expl = explode('-', $tanggal);
          $dt   = implode('', $dt_expl);
          if ($last_transaksi->max_id==null) {
            $last_transaksi_id="TR-BL-$dt-000000";
          }else{
            $last_transaksi_id = $last_transaksi->max_id;
          }

          //Membuat Kode Baru Pembayaran Transaksi
          $last_trans_expl=explode("-", $last_transaksi_id);
          $get_last_trans = $last_trans_expl[3];
          $new_transaksi_id = 'TR-BL-'.$dt.'-'.sprintf("%06d", $get_last_trans+1);
          $count_barang=0;
          $tgl_transaksi = $tanggal;
          foreach ($this->cart->contents() as $items) {
          	$data_transaction['transaksi_detail'][$count_barang]=array('id_transaksi_belanja' => $new_transaksi_id, 
          									'id_barang' => $items['id_barang'],
          									'qty' => $items['qty'],
          									'harga_beli' => $items['harga_beli'],
          									'harga_jual_angsur' => $items['harga_jual_angsur'],
          									'harga_jual_tunai' => $items['harga_jual_tunai'],
							   				'user_id-add' => $this->ion_auth->user()->row()->id,
							   				'date_created' => date('Y-m-d G:i:s')
          							  );
          	$data_transaction['stok_barang'][$count_barang]=array('keterangan_transaksi' =>$new_transaksi_id, 
          									'id_barang' => $items['id_barang'],
          									'masuk' => $items['qty'],
          									'keterangan' => 'Transaksi Belanja Barang',
          									'tanggal' => $tanggal,          								  
          								  	'waktu' => date('G:i:s'),
							   				'user_id-add' => $this->ion_auth->user()->row()->id,
							   				'date_created' => date('Y-m-d G:i:s')
          							  );
          	$count_barang++;
          }
          $data_transaction['transaksi_header'][0]=array('id_transaksi_belanja' => $new_transaksi_id,
          								  'id_suplier' => $id_suplier,
          								  'tanggal' => $tanggal,          								  
          								  'waktu' => date('G:i:s'),
          								  'total_pembayaran' => $this->cart->total(),
							   			  'user_id-add' => $this->ion_auth->user()->row()->id,
							   			  'date_created' => date('Y-m-d G:i:s')
          						    );
//		$this->load->view('admin/belanjabarang/content_search_suplier',$data);
          
      if ($transaction=$this->Transaction_model->create_transaction_belanja($data_transaction)) {
        $this->cart->destroy();
        $data['transaksi_header'] = $this->Transaction_model->get_transaksi_bayar_header($new_transaksi_id)->row();
      	$data['transaksi_detail'] = $this->Transaction_model->get_transaksi_bayar_detail($new_transaksi_id)->result();
		$this->load->view('admin/belanjabarang/content_nota_sukses',$data);
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
      		$last_transaksi_id = $id_transaksi;
      		$this->data['transaksi_header'] = $this->Transaction_model->get_transaksi_bayar_header($last_transaksi_id)->row();
      	$this->data['transaksi_detail'] = $this->Transaction_model->get_transaksi_bayar_detail($last_transaksi_id)->result();
			$this->template->admin_render('admin/belanjabarang/content_nota_sukses', $this->data);
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
		$this->page_title->push('Daftar Transaksi Belanja Barang');
		$this->data['pagetitle'] = $this->page_title->show();
      	$this->data['transaksi_header'] = $this->Transaction_model->get_all_transaksi_bayar_header()->result();
		$this->template->admin_render('admin/belanjabarang/daftar_semua', $this->data);
      }
	}

	public function bysuplier()
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->show_menu_check();
		$this->access_menu();
      	$this->breadcrumbs->unshift(2, 'Create', 'admin/belanjabarang/bysuplier');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->page_title->push('Daftar Transaksi Belanja Barang');
		$this->data['pagetitle'] = $this->page_title->show();
      	$this->data['bysuplier'] = $this->Transaction_model->get_all_transaksi_bayar_header_bysuplier()->result();
		$this->template->admin_render('admin/belanjabarang/daftar_bysuplier', $this->data);
      }
	}

	public function bysuplierdetail($id_suplier=null)
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->show_menu_check();
		$this->access_menu();
      	$this->breadcrumbs->unshift(2, 'Create', 'admin/belanjabarang/bysuplier');
		$this->data['breadcrumb'] = $this->breadcrumbs->show();
		$this->page_title->push('Daftar Transaksi Belanja Barang');
		$this->data['pagetitle'] = $this->page_title->show();
		$this->template->admin_render('admin/belanjabarang/daftar_bysuplierdetail', $this->data);
      }
	}

	public function bysuplierdetail_cetak($id_suplier=null,$tgl_mulai=null,$tgl_selesai=null)
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $data_perpage['tgl_mulai'] = $tgl_mulai;
        $data_perpage['tgl_selesai'] = $tgl_selesai;
        $data_perpage['kud'] = $this->Kud_model->get_all();
      	$multi_id_transaksi = $this->Transaction_model->get_id_transaksi_belanja_by_suplier($id_suplier,$tgl_mulai,$tgl_selesai)->row();
      	$bysuplier = $this->Transaction_model->get_transaksi_bayar_detail_multi_id_transaksi($multi_id_transaksi->id_trans);
      	$header= $this->Transaction_model->get_by_id_suplier_transaksi_bayar_header($id_suplier,$tgl_mulai,$tgl_selesai);

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

  public function bybarangdetail($id_barang=null)
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
    $this->template->admin_render('admin/belanjabarang/daftar_bybarangdetail', $this->data);
      }
  }

  public function bybarangdetail_cetak($id_barang=null,$tgl_mulai=null,$tgl_selesai=null)
  {
    if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
        $data_perpage['tgl_mulai'] = $tgl_mulai;
        $data_perpage['tgl_selesai'] = $tgl_selesai;
        $data_perpage['kud'] = $this->Kud_model->get_all();
        $data_perpage['barang'] = $this->Barang_model->get_by_id($id_barang)->row();
        $bybarang= $this->Transaction_model->get_by_periode_all_transaksi_belanja_detail_bybarang($id_barang,$tgl_mulai,$tgl_selesai);

        // Jika Data Kosong
         $count_detail_bybarang = count($bybarang->result_array());
   
        if ($count_detail_bybarang > 0 ) {
          $data['detail'][0]=array('id_transaksi_belanja' => 'ID Transaksi Belanja',
                              'id_detail' =>'header',
                              'id_barang' =>'',
                              'nama_barang' =>'Nama Barang',
                              'qty' =>'Qty',
                              'harga_beli' =>'Harga Beli',
                              'harga_jual_tunai' =>'',
                              'harga_jual_angsur' =>'',
                              'total' => ''
                        );
          $no=1;
          foreach ($bybarang->result_array() as $key => $v_detail) {
            $data['detail'][$key+1]=array('id_transaksi_belanja' => $v_detail['id_transaksi_belanja'],
                              'id_detail' =>$v_detail['id_detail'],
                              'id_barang' =>$v_detail['id_barang'],
                              'qty' =>$v_detail['qty'],
                              'harga_beli' =>$v_detail['harga_beli'],
                              'tanggal' =>$v_detail['tanggal'],
                              'no' =>$no,
                              'total' => $v_detail['qty']*$v_detail['harga_beli']
                        );
          $no++;
          }
        }
    
/*
    //ISeng
    unset($data['detail']);
    $x=1;
    for ($i=0; $i <120; $i++) { 
      $data['detail'][$i]=array
            ('id_transaksi_belanja'=>$i,
                      'id_detail' =>$x,
                      'nama_barang' =>'x'.$i.'-'.$x,
                      'qty' =>'',
                      'harga_beli' =>'' ,
                      'harga_jual_tunai' =>'',
                      'harga_jual_angsur' =>'',
                      'total' => '',
                      'no' =>$x,
                      'tanggal' =>date('d-m-Y'),
                  );
            $x++;
    }
    $count_detail_bybarang = count($data['detail']);
    
  //  var_dump($data['detail']);
        
    /* DEFAULT VALUE
        $maks_baris_perhalaman_h_f = 31;
        $maks_baris_perhalaman_h = 36;
        $maks_baris_perhalaman_f = 38;
        $maks_baris_perhalaman = 43;
        */
      //  var_dump($data['detail']);
        $maks_baris_perhalaman_h_f = 29;
        $maks_baris_perhalaman_h = 36;
        $maks_baris_perhalaman_f = 41;
        $maks_baris_perhalaman = 45;
        $page=1;

        //if ($count_detail_bybarang > 0 and $count_header > 0) {
        if ($count_detail_bybarang > 0) {
          
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
              
            //  echo count($data_perpage['detail_perpage'][$page]);
              
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
       // $data_perpage['header'] = $data['header'];
      }
      //exit; 
      //if ($count_detail_bybarang==0 and $count_header == 0) {
      if ($count_detail_bybarang==0) {
        $data_perpage['empty'] ='y';
      }else{
        $data_perpage['empty'] ='n';
      }
      $this->load->view('admin/belanjabarang/content_daftar_bybarangdetail', $data_perpage);
    //exit;
      }
  }


	public function deletedtransaksi()
	{
	  if ( !$this->ion_auth->logged_in()){
        redirect('auth/login', 'refresh');
      }else{
      	$this->show_menu_check();
		$this->access_menu();
      	$this->data['transaksi_header'] = $this->Transaction_model->get_all_deleted_transaksi_bayar_header()->result();
		$this->load->view('admin/belanjabarang/content_daftardihapus', $this->data);
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

		$get_data_transaksi_bayar = $this->Transaction_model->get_by_id_transaksi_bayar_header($this->input->post('id'))->row();
		$get_data_transaksi_bayar_detail = $this->Transaction_model->get_transaksi_bayar_detail($get_data_transaksi_bayar->id_transaksi_belanja)->result();
		$get_stok = $this->Barang_model->get_stok_by_id_transaksi($get_data_transaksi_bayar->id_transaksi_belanja)->result();

		$count = 0;
		foreach ($get_data_transaksi_bayar_detail as $dt) {
			$data_del['detail'][$count] = array(
				   'id_detail' => $dt->id_detail,
				   'deleted_status' => $deleted_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);
			$count++;
		}

		$count = 0;
		foreach ($get_stok as $stok) {
			$data_del['stok'][$count] = array(
				   'id_stok' => $stok->id_stok,
				   'delete_status' => $deleted_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);
			$count++;
		}

		$data_del['header'][1] = array(
				   'id' => $this->input->post('id'),
				   'deleted_status' => $deleted_status,
				   'user_id-del' => $this->ion_auth->user()->row()->id,
				   'last_deleted' => date('Y-m-d G:i:s')
		);

		if($this->Transaction_model->update_transaksi_belanja_header($data_del))
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

}
