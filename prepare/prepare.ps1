$jjcRootPath = "C:\JJC_work"
$projectRootPath = Join-Path $jjcRootPath "2024_Social_Game"

$pathArray = @();
$pathArray += $jjcRootPath
$pathArray += $projectRootPath
$pathArray += Join-Path $projectRootPath "00_Text"
$pathArray += Join-Path $projectRootPath "01_XAMPP"
$pathArray += Join-Path $projectRootPath "02_HTML"
$pathArray += Join-Path $projectRootPath "03_PHP"
$pathArray += Join-Path $projectRootPath "04_SQL"
$pathArray += Join-Path $projectRootPath "05_Key"
$pathArray += Join-Path $projectRootPath "06_Unity"
$pathArray += Join-Path $projectRootPath "07_Java"

foreach($path in $pathArray){

    if( Test-Path $path ){
        Write-Output "$path is exist"
    }else{
        New-Item $path -ItemType Directory
    }
}
