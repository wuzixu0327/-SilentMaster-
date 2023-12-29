<?php

interface Affairs_Edit
{
    public function Affairs_Delete($ID);
    public function Affairs_Edit($News_ID,$News_Title,$News_massage);
    public function Affairs_getmassage($ID);
}