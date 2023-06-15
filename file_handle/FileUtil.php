<?php

class FileUtil{

	public static function writeString2File($fileName, $string){
		$fp = fopen($fileName, 'w');
		fwrite($fp, $string);
		fclose($fp);
	}

	public static function readFile2String($fileName){
		if (!file_exists($fileName)) {
			return '';
		}
		return file_get_contents($fileName);
	}

	public static function getPoolFileName() {
		return TMPPATH . "/connectionPool.txt";
	}

	public static function readCsv($filePath) {
		if (($handle = fopen($filePath, 'r')) !== FALSE) {
			// Đọc từng dòng của file
			while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
				// Lấy giá trị từng trường của dòng
				$field1 = $data[0];
				$field2 = $data[1];
				$field3 = $data[2];
				// Xử lý dữ liệu theo ý muốn
				echo $field1 . ' ' . $field2 . ' ' . $field3 . '<br>';
			}
			// Đóng file
			fclose($handle);
		}
	}

	public static function exportCsv() {
		// Mảng dữ liệu để xuất ra CSV
		$data = array(
			array('Họ tên', 'Email', 'Điện thoại'),
			array('John Doe', 'johndoe@example.com', '123456789'),
			array('Jane Smith', 'janesmith@example.com', '987654321'),
			array('Bob Johnson', 'bjohnson@example.com', '5551234')
		);

		// Mở file CSV để ghi dữ liệu
		$fp = fopen('file.csv', 'w');

		// Ghi dữ liệu vào file
		foreach ($data as $fields) {
			fputcsv($fp, $fields);
		}

		// Đóng file CSV
		fclose($fp);

		// Thiết lập header để tải file CSV
		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="file.csv"');

		// Đọc file CSV và hiển thị nội dung
		readfile('file.csv');

	}

	public static function readXlsx() {
		// Create a new PHPExcel object
		$objPHPExcel = PHPExcel_IOFactory::load('path/to/file.xlsx');

		// Get the first worksheet in the file
		$worksheet = $objPHPExcel->getActiveSheet();

		// Get the highest row and column numbers in the worksheet
		$highestRow = $worksheet->getHighestRow();
		$highestColumn = $worksheet->getHighestColumn();

		// Loop through each row in the worksheet
		for ($row = 1; $row <= $highestRow; $row++) {
			// Loop through each column in the row
			for ($col = 'A'; $col <= $highestColumn; $col++) {
				// Get the value in the current cell
				$cellValue = $worksheet->getCell($col . $row)->getValue();
				// Do something with the cell value
				echo $cellValue . ' ';
			}
			// Move to the next line
			echo '<br>';
		}

	}

	public static function exportXlsx(){
		// Tải thư viện PHPExcel
		require_once 'PHPExcel/Classes/PHPExcel.php';



		// Tạo đối tượng PHPExcel
		$objPHPExcel = new PHPExcel();

		// Đặt thuộc tính cho file Excel
		$objPHPExcel->getProperties()->setCreator("Your Name")
			->setLastModifiedBy("Your Name")
			->setTitle("Title")
			->setSubject("Subject")
			->setDescription("Description")
			->setKeywords("excel php")
			->setCategory("Category");

		// Thêm dữ liệu vào sheet đầu tiên
		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Họ tên')
			->setCellValue('B1', 'Email')
			->setCellValue('C1', 'Điện thoại')
			->setCellValue('A2', 'John Doe')
			->setCellValue('B2', 'johndoe@example.com')
			->setCellValue('C2', '123456789')
			->setCellValue('A3', 'Jane Smith')
			->setCellValue('B3', 'janesmith@example.com')
			->setCellValue('C3', '987654321')
			->setCellValue('A4', 'Bob Johnson')
			->setCellValue('B4', 'bjohnson@example.com')
			->setCellValue('C4', '5551234');

		// Thiết lập header để tải file Excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="file.xlsx"');
		header('Cache-Control: max-age=0');

		// Tạo một Writer để xuất file Excel
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		// Ghi dữ liệu vào output
		$objWriter->save('php://output');
	}

	public static function readTxt($readAll, $readByLine) {
		if ($readAll) {
			// Đọc dữ liệu từ file text.txt
			$data = file('text.txt');
			// Hiển thị nội dung file
			foreach ($data as $line) {
				echo $line . '<br>';
			}
		}

		if ($readByLine) {
			// Mở file text.txt
			$file = fopen('text.txt', 'r');
			// Đọc và hiển thị từng dòng trong file
			while (!feof($file)) {
				$line = fgets($file);
				echo $line . '<br>';
			}
			// Đóng file
			fclose($file);
		}
	}

	public static function exportTxt($data) {
		// case 1: using file_put_contents
		file_put_contents('text.txt', $data); // overwrite old data

		file_put_contents('text.txt', $data, FILE_APPEND); // append new data

		// case 2: using fwrite
		$file = fopen('text.txt', 'w');
		fseek($file, 0, SEEK_END); // thêm con trỏ ở cuối file nếu muốn  append thêm dữ liệu
		fwrite($file, $data);
		fclose($file);
	}

	public static function exportFileUsingNonBlocking() {

		// Open the output file for writing
		$file = fopen('output.csv', 'w');

		// Set the file to non-blocking mode
		stream_set_blocking($file, 0);

		// Set the write buffer size
		stream_set_write_buffer($file, 8192);
		// Loop through the data and write it to the file
		for ($i = 1; $i < 10000000; $i++) {
			fwrite($file, "Hello {$i}" . "\n");
//			$info = stream_get_meta_data($file);
//			if ($info['unread_bytes'] === 0) {
//				// Nếu stream đã sẵn sàng để ghi, dừng vòng lặp và trả về response cho client
//				break;
//			}
		}
		// Close the file
		fclose($file);
	}
}
