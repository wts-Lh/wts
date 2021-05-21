<?php
header('Content-type:text/html; charset=utf-8');
$con=mysqli_connect("8.136.232.136","root","12345678","wts");
require_once '../PHPExcel/PHPExcel/IOFactory.php';//引入PHPExcel类库
/*读取excel文件，并进行相应处理*/

//$fileName='cs.xlsx';

$fileName='';
if ($_FILES["file"]["error"] > 0)
{
    echo "错误：" . $_FILES["file"]["error"] . "<br>";
}
else
{
    $fileName = $_FILES["file"]["name"] ;

}
if (!file_exists($fileName)) {
    exit("文件".$fileName."不存在");
}
$objPHPExcel = PHPExcel_IOFactory::load($fileName);//获取sheet表格数目
$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

$sheetCount = $objPHPExcel->getSheetCount();//默认选中sheet0表
$sheetSelected = 0;
$objPHPExcel->setActiveSheetIndex($sheetSelected);//获取表格行数
$rowCount = $objPHPExcel->getActiveSheet()->getHighestRow();//获取表格列数
$columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();
$dataArr = array();
$a=0;
$b=0;
/* 循环读取每个单元格的数据 */
//行数循环
for ($row = 1; $row <= $rowCount; $row++){
//列数循环 , 列数是以A列开始
    for ($column = 'A'; $column <= $columnCount; $column++) {

        $dataArr[]= $objPHPExcel->getActiveSheet()->getCell($column.$row)->getValue();
        $a++;
    }
    $yz="SELECT * FROM cs where a ='$dataArr[0]'";
    $ret1=mysqli_query($con, $yz);
    if($ret1){
        $b++;
    }else
    {
        $sql = "INSERT INTO cs(a, b, c)
            VALUES ('$dataArr[0]','$dataArr[1]','$dataArr[2]')";
        $ret = mysqli_query($con,$sql);
        if($ret)
        {
            echo "ok";
        }
        else
        {
            echo "注册失败";
        }
    }
    $a=0;
    $dataArr = NULL;
}
echo "有".$b."个学生已经添加";
?>
