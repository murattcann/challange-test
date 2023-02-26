<?php
namespace App\Controllers;
use App\Models\JobModel;

class ExcelController extends BaseController
{
    private JobModel $model;
    public function __construct(){
        $this->model = new JobModel();
    }

    public function  importExcel(){

        $excelFile = ("./hits.xls");
        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadSheet = $Reader->load($excelFile);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        $rows = [];
        $saved = false;

        // setting Excel rows and adding to $rows array
        for ($i = 0; $i <= $sheetCount; $i ++) {
            if($i == 0) continue;
            if(isset($spreadSheetAry[$i]))  $rows[] = array_combine($spreadSheetAry[0], $spreadSheetAry[$i]);
        }

        // if rows exists in Excel file
        if(count($rows) > 0 ){
            // truncate table to prevent table data from duplicate
            // this is for only this case. generally we may run an update query instead of truncate.
            $this->model->truncate();
            foreach ($rows as $row){
                $saved = $this->model->insert($row);
            }
        }

        if($saved){
            echo "Excel data imported successfully";
            return true;
        }

        echo "An error has occurred while importing the excel file.";
    }


    public function getJobReport(){
        $reportData = $this->model->getJobReport();

        return $this->view('job-report', ["rows" => $reportData, "title" => "Job Hits Report"]);
    }
}