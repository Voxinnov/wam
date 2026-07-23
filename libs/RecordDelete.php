<?php

class RecordDelete extends MySql{
		


	
	

			
			function deleteSlider($id){
				$query="SELECT * FROM `rithu_slider` WHERE `rithu_slider_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/slider/'.$rec[0]['rithu_slider_photo']);
					
					$this->delete('rithu_slider','`rithu_slider_id`='.$id);
					
					
				
			}

				function deletGalleryList($id){
				$query="SELECT * FROM `gal_lst` WHERE `gal_lst_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('../travel_admin/upload/Gallery/'.$rec[0]['gal_lst_img']);
					$this->delete('gal_lst','`gal_lst_id`='.$id);
					
					
				
			}



			function deletePlace($id){
				$query="SELECT * FROM `place_details` WHERE `place_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('place_details','`place_id`='.$id);
					
					
				
			}

					function deletePlace_img($id){
				$query="SELECT * FROM `place_images` WHERE `place_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/Placeimg/'.$rec[0]['place_img']);
					
					$this->delete('place_images','`place_id`='.$id);
					
					
				
			}

		function deleteGallery($id){
				$query="SELECT * FROM `rithu_gal` WHERE `rithu_gal_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('../rithu_admin/upload/Gallery/'.$rec[0]['rithu_gal_img']);
					$this->delete('rithu_gal','`rithu_gal_id`='.$id);
					
					
				
			}
			




		
		function deletedesti_img($id){
				$query="SELECT * FROM `desti_img` WHERE `about_img_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/desti/'.$rec[0]['about_img_photo']);
					
					$this->delete('desti_img','`about_img_id`='.$id);
					
					
				
			}

		function deleteservice_img($id){
				$query="SELECT * FROM `service_img` WHERE `service_img_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/service/'.$rec[0]['service_img_photo']);
					
					$this->delete('service_img','`service_img_id`='.$id);
					
					
				
			}
				function deleteService($id){
				$query="SELECT * FROM `service_block` WHERE `b_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('service_block','`b_id`='.$id);
					
					
				
			}
			function deleteActivity($id){
				$query="SELECT * FROM `activity` WHERE `activity_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('activity','`activity_id`='.$id);
					
					
				
			}
			function deleteactivity_img($id){
				$query="SELECT * FROM `activity_images` WHERE `activity_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/Activity/'.$rec[0]['activity_img']);
					
					$this->delete('activity_images','`activity_id`='.$id);
					
					
				
			}



			function deleteTour($id){
				$query="SELECT * FROM `tours_details` WHERE `tours_details_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('tours_details','`tours_details_id`='.$id);
					
					
				
			}


			function deletetour_img($id){
				$query="SELECT * FROM `tours_images` WHERE `tours_details_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/Tour/'.$rec[0]['tours_img']);
					
					$this->delete('tours_images','`tours_details_id`='.$id);
					
					
				
			}
	

			function deleteTestimonial($id){
				$query="SELECT * FROM `testim` WHERE `testim_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('testim','`testim_id`='.$id);
					
					
				
			}
			
				function deletVideo($id){
				$query="SELECT * FROM `virtual_tour` WHERE `virtual_tour_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('virtual_tour','`virtual_tour_id`='.$id);
					
					
				
			}


				function deleteHotel($id){
				$query="SELECT * FROM `hotels` WHERE `hot_id`='".$id."'";
					$rec=$this->fetchAll($query);
									
					$this->delete('hotels','`hot_id`='.$id);
					
					
				
			}


			function deletehotel_img($id){
				$query="SELECT * FROM `hotel_images` WHERE `hot_img_id`='".$id."'";
					$rec=$this->fetchAll($query);
					unlink('admin/upload/hotel/'.$rec[0]['hot_img']);
					
					$this->delete('hotel_images','`hot_img_id`='.$id);
					
					
				
			}
			function deleteManagement($id){
				$query="SELECT * FROM `gip_ofc_brers` WHERE `gip_ofc_brers_id`='".$id."'";
					$rec=$this->fetchAll($query);
					
					
					$this->delete('gip_ofc_brers','`gip_ofc_brers_id`='.$id);
					
					
				
			}

	function deleteClassifieds($id){
				$query="SELECT * FROM `classifies` WHERE `clas_id`='".$id."'";
					$rec=$this->fetchAll($query);
					
					
					$this->delete('classifies','`clas_id`='.$id);
					
					
				
			}



			
			
			

}