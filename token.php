<?php
$creds = json_decode(file_get_contents('assets/creds.json') , true);
$ssoToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJ1bmlxdWUiOiJjMTQ2NGVlZi1mZmNmLTRmMWEtYTU5NC0yMGRiYTI1ZTgyNjYiLCJ1c2VyVHlwZSI6IlJJTHBlcnNvbiIsImF1dGhMZXZlbCI6IjQwIiwiZGV2aWNlSWQiOiI3ZTk5ZGU1Y2JiYjllYjU0NDY3ZGQ5NWY5NzlhOWRhYjQ2ZDdhOTMyMmUxMWNkNTA1MTMxYzUzNDQxYmI0NTVjY2E3ZTY1ZjI0NGQ1YTdmY2M3NGM4ODY3ZTI3YWJjODk0ZjBiYWM0NzEzYzZiNWM3ZWRlNmJjOWI3MmQzYTVmNCIsImp0aSI6IjQwYTBkNGExLWRhNjEtNGQwZC04ZDg4LWRmOWQwYmI2MzZhYyIsImlhdCI6MTY1MTQ5MzUyMn0.HUJsxv0nigRyhWmsZgPsX7XonTT3A-iWVVfshcRszADi6Xi9fhdc0RbjZYNL2ZD2RfnxMmutRkhpJpum_2TMag";

$jctBase = "cutibeau2ic";

function tokformat($str)
{
    $str = base64_encode(md5($str, true));
    return str_replace("\n", "", str_replace("\r", "", str_replace("/", "_", str_replace("+", "-", str_replace("=", "", $str)))));
}
function generateJct($st, $pxe)
{
    global $jctBase;
    return trim(tokformat($jctBase . $st . $pxe));
}
function generatePxe()
{
    return time() + 6000000;
}
function generateSt()
{
    global $ssoToken;
    return tokformat($ssoToken);
}
function generateToken()
{
    $st = generateSt();
    $pxe = generatePxe();
    $jct = generateJct($st, $pxe);
    return "?jct=" . $jct . "&pxe=" . $pxe . "&st=" . $st;
}

$token = generateToken();
?>
