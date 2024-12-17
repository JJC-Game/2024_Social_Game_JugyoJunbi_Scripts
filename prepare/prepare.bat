cd %~dp0
@powershell Set-ExecutionPolicy Bypass -Scope CurrentUser
@powershell Get-ExecutionPolicy
@REM powershell Set-ExecutionPolicy RemoteSigned
@REM Set-ExecutionPolicy Undefined -Scope Process -Force

powershell -File prepare.ps1

@powershell Set-ExecutionPolicy Restricted -Scope CurrentUser
@powershell Get-ExecutionPolicy