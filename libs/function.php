<?php

function view($files,$data = [])
{
    //  简便接收的数据
    //   将数组变量化
    extract($data);
    include(ROOT.'views/'.$files.'.html');
}