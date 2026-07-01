$content = Get-Content -LiteralPath 'C:\Users\xxoca\OneDrive\Desktop\git\lix.php' -Raw -Encoding UTF8
Write-Output ('File length: ' + $content.Length)
Write-Output ''
Write-Output '=== Header (first 2000 chars) ==='
Write-Output $content.Substring(0, [Math]::Min(2000, $content.Length))

# Find base64 blob after eNq (gzip magic in base64)
$idx = $content.IndexOf('eNq')
if ($idx -lt 0) { $idx = $content.IndexOf('eNp') }
Write-Output ''
Write-Output ('Base64 start index: ' + $idx)

if ($idx -ge 0) {
    $tail = $content.Substring($idx)
    if ($tail -match '^([A-Za-z0-9+/=\r\n]+)') {
        $b64 = $Matches[1] -replace '\s',''
    } else {
        # grab until closing quote paren
        $end = $tail.IndexOf('")')
        if ($end -lt 0) { $end = $tail.Length }
        $b64 = $tail.Substring(0, $end) -replace '[^A-Za-z0-9+/=]',''
    }
    Write-Output ('Base64 length: ' + $b64.Length)
    $raw = [Convert]::FromBase64String($b64.Substring(0, $b64.Length - ($b64.Length % 4)))
    Write-Output ('Raw bytes: ' + $raw.Length)
    Write-Output ('Magic bytes: {0:X2} {1:X2}' -f $raw[0], $raw[1])

    Add-Type -AssemblyName System.IO.Compression
    # PHP gzuncompress = zlib wrapper (78 9C) + deflate
    $ms = New-Object System.IO.MemoryStream(,$raw)
    $null = $ms.ReadByte()
    $null = $ms.ReadByte()
    $deflate = New-Object System.IO.Compression.DeflateStream($ms, [System.IO.Compression.CompressionMode]::Decompress)
    $out = New-Object System.IO.MemoryStream
    $deflate.CopyTo($out)
    $text = [System.Text.Encoding]::UTF8.GetString($out.ToArray())
    Write-Output ('Decompressed: ' + $out.Length + ' bytes')
    Write-Output ''
    Write-Output '=== Payload start (4000 chars) ==='
    Write-Output $text.Substring(0, [Math]::Min(4000, $text.Length))

    $keywords = @(
        'file_put_contents','scandir','glob','vendor','repository','eval','chmod',
        'fwrite','move_uploaded','abcdefghijklmnopqrstuvwxyz','chr(','include',
        'RecursiveDirectory','is_writable','getcwd','gzinflate','shell_exec',
        'system','passthru','curl_exec','mail(','preg_replace'
    )
    Write-Output ''
    Write-Output '=== Keywords ==='
    foreach ($kw in $keywords) {
        if ($text.Contains($kw)) { Write-Output ('FOUND: ' + $kw) }
    }

    $outPath = 'C:\Users\xxoca\OneDrive\Desktop\git\scripts\lix-decoded.txt'
    [System.IO.File]::WriteAllText($outPath, $text)
    Write-Output ''
    Write-Output ('Full payload: ' + $outPath)
}
