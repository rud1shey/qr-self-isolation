@extends('layouts.app')


<?php
echo \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate("Amedora33") . "<br>";
?>

<div class="visible-print text-center">
{{--    {!! QrCode::size(100)->generate(Request::url()); !!}--}}
    <p>Scan me to return to the original page.</p>
</div>
