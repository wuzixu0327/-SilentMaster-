<?php

interface Notice_Edit
{
    public function Notice_Delete($ID);
    public function Notice_Edit($News_ID,$News_Title,$News_massage);
    public function Notice_getmassage($ID);
}