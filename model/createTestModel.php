<?php

/*
 * @author :Siddarth Chowdhary @created on :08-05-2013 @desc		 :Model to create a test. ***************Modifed Log ******************************** Name			Task			Date			Description ***********************************************************
 */
include MODEL_PATH . "db_connect.php";
class createTestModel extends dbConnectModel {
	function __construct() {
		parent::__construct ();
	}
	
	// creating a new test
	public function createNewTest($arrArgs) {
		try {
			if (! empty ( $arrArgs )) {
				// query to insert data in table test
				$data ['tables'] = 'test';
				$data ['columns'] = array (
						'name' => $arrArgs ['testName'],
						'created_on' => 'NOW()',
						'updated_on' => 'NOW()',
						'created_by' => $arrArgs ['user_id'] 
				);
				$result_query_1 = $this->_db->insert ( $data ['tables'], $data ['columns'] );
				
				$testId = $this->_db->lastInsertId ();
				for($i = 0; $i < count ( $arrArgs [categoryName] ); $i ++) {
					// query to select cat id from category table for a particular category name
					$data ['tables'] = 'category';
					$data ['columns'] = array (
							'id' 
					);
					$data ['conditions'] = array (
							'name' => $arrArgs ['categoryName'] [$i] 
					);
					$result_select = $this->_db->select ( $data );
					$row = $result_select->fetch ( PDO::FETCH_ASSOC );
					if (! empty ( $row ['id'] )) {
						$catId = $row ['id'];
					} else {
						return false;
					}
					// query to insert data in the test_category table
					$data ['tables'] = 'test_category';
					$data ['columns'] = array (
							'test_id' => $testId,
							'cat_id' => $catId,
							'created_on' => 'NOW()',
							'updated_on' => 'NOW()',
							'created_by' => $arrArgs ['user_id'] 
					);
					
					$result_query_2 = $this->_db->insert ( $data ['tables'], $data ['columns'] );
				}
				if ($result_query_1) {
					if ($result_query_2) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			}
		} catch ( Exception $e ) {
			$this->handleException ( $e->getMessage () );
		}
	}
	
	// Viewing Tests categories
	public function getTestCategories($arrArgs) {
		try {
			$categoryArray = array ();
			$data ['tables'] = 'category';
			$data ['columns'] = array (
					'name',
					'id' 
			);
			$data ['conditions'] = array (
					'created_by' => $arrArgs ['id'] 
			);
			
			$result = $this->_db->select ( $data );
			// print_r($result);
			while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
				$categoryArray ['category_name'] [] = $row ['name'];
				$categoryArray ['category_id'] [] = $row ['id'];
			}
			// print_r($categoryArray);die("here");
			return $categoryArray;
		} catch ( Exception $e ) {
			$this->handleException ( $e->getMessage () );
		}
	}
	
	// Viewing Tests categories
	public function getTestNames($arrArgs) {
		try {
			$TestArray = array ();
			$data ['tables'] = 'test';
			$data ['columns'] = array (
					'name',
					'id' 
			);
			$data ['conditions'] = array (
					'created_by' => $arrArgs ['id'] 
			);
			
			$result = $this->_db->select ( $data );
			// print_r($result);
			while ( $row = $result->fetch ( PDO::FETCH_ASSOC ) ) {
				$TestArray ['testName'] [] = $row ['name'];
				$TestArray ['testId'] [] = $row ['id'];
			}
			// print_r($categoryArray);die("here");
			return $TestArray;
		} catch ( Exception $e ) {
			$this->handleException ( $e->getMessage () );
		}
	}
	
	// Deleting Test
	public function deleteTest() {
		try {
			/*
			 * echo "hi"; $data['tables'] = 'category'; $data['conditions']=array('id'=>$cat_id); $result = $this->_db->delete($data['tables'],$data['conditions']); if($result) { return "done"; }else { return "error"; }
			 */
		} catch ( Exception $e ) {
			$this->handleException ( $e->getMessage () );
		}
	}
	
	// Updating Test
	public function updateTest($arrArgs) {
		try {
			echo '<pre>';
			print_r($arrArgs);
			//update in table test
			$data = array('name' => $arrArgs['testName']);
			$where = array('id' => $arrArgs['test_id']);
			$result_update = $this->_db->update('test', $data, $where);
			//print_r($result_update);
			$result_delete = $this->_db->delete('test_category', array('test_id' => $arrArgs['test_id']));
			//print_r($result_delete);
			
			
			for($i = 0; $i < count ( $arrArgs ['categoryName'] ); $i ++) {
				// query to select cat id from category table for a particular category name
				$data ['tables'] = 'category';
				$data ['columns'] = array (
						'id'
				);
				$data ['conditions'] = array (
						'name' => $arrArgs ['categoryName'] [$i]
				);
				$result_select = $this->_db->select ( $data );
				$row = $result_select->fetch ( PDO::FETCH_ASSOC );
				if (! empty ( $row ['id'] )) {
					$catId = $row ['id'];
				} else {
					return false;
				}
				// query to insert data in the test_category table
				$data ['tables'] = 'test_category';
				$data ['columns'] = array (
						'test_id' => $arrArgs['test_id'],
						'cat_id' => $catId,
						'created_on' => 'NOW()',
						'updated_on' => 'NOW()',
						'created_by' => $arrArgs ['user_id']
				);
					
				$result_insert = $this->_db->insert ( $data ['tables'], $data ['columns'] );
				//print_r($result_insert);
				if ($result_update && $result_delete && $result_insert) {
					return true;
				} else {
					return false;
				}
			}
			
		} catch ( Exception $e ) {
			$this->handleException ( $e->getMessage () );
		}
	}
}


