<?php

interface Match_Edit
{
    public function Match_Delete($ID);
    public function Match_Edit($Match_ID,$Match_Name,$Match_Organ,$Match_StartTime,$Match_EndTime,$Match_Annex,$Match_Type,$Match_NumberLimit,$Mtach_Massage);
}