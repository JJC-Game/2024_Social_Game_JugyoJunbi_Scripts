$jjcRootPath = "C:\JJC_work"
$projectRootPath = Join-Path $jjcRootPath "2024_Social_Game"

$pathArray = @();
$pathArray += $jjcRootPath
$pathArray += $projectRootPath
$pathArray += Join-Path $projectRootPath "xampp"
$pathArray += Join-Path $projectRootPath "Unity"
$pathArray += Join-Path $projectRootPath "PHP"
$pathArray += Join-Path $projectRootPath "Key"
$pathArray += Join-Path $projectRootPath "Daily"

foreach($path in $pathArray){

    if( Test-Path $path ){
        Write-Output "$path is exist"
    }else{
        New-Item $path -ItemType Directory
    }
}
