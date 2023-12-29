<?php

interface News_Edit
{
    public function News_Delete($ID);
    public function News_Edit($News_ID,$News_Title,$News_href,$News_massage);
    public function News_getmassage($ID);
}