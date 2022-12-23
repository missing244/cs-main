<?php
$can_upload = array(array("eea265e9-07b6-4d2c-ab50-10054c856ce5","110110"));


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["file2"];
    $pass = $_POST["file3"];
    $found1 = 0;
    for($count1=0;$count1 < count($can_upload);$count1++)
    {
        if($can_upload[$count1][0] == $name)
        {
            $found1 = 1;
            if($can_upload[$count1][1] == $pass) upload_process();
            else echo "填入信息有误";
        }
        if ($found1 == 0) echo "填入信息有误";
    }
}
else echo "错误";


function upload_process()
{
    $extension = end(explode(".", $_FILES["file1"]["name"]));        // 获取文件后缀名
    if (($_FILES["file1"]["size"] < 1024 * 1024 * 5) && in_array($extension, array("zip")))
    {
        if ($_FILES["file1"]["error"] > 0)
        {
            echo "上传失败：: " . $_FILES["file1"]["error"] . "<br>";
        }
        else
        {
            echo "上传成功，以下是文件信息: <br><br>";
            echo "上传文件名: " . $_FILES["file1"]["name"] . "<br>";
            echo "文件类型: " . $_FILES["file1"]["type"] . "<br>";
            echo "文件大小: " . ($_FILES["file1"]["size"] / 1024) . " kB<br>";
            echo "<br>";
            echo "<br>";
            echo "文件正在后台验证，这需要一定时间<br>";
            echo "验证完成后，文件将立刻装载并可以进行更新<br>";

            move_uploaded_file($_FILES["file1"]["tmp_name"], $_FILES["file1"]["name"]);
            chmod($_FILES["file1"]["name"],000);
        }      
    }
    else
    {
        echo $_FILES["file1"]["name"] . " 并不是zip压缩文件<br>";
    }
}

?>