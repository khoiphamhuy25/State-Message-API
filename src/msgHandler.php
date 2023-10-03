<?php
include_once('msgModel.php');

class msgHandler
{
    private msgModel $message;

    public function __construct(string $mess)
    {
        $this->message = new msgModel($mess);
    }

    public function getMessage(): msgModel
    {
        return $this->message;
    }

    public function setMessage(msgModel $message): void
    {
        $this->message = $message;
    }


    //Nhận message từ web
    public function parse(): string
    {
        if (isset($this->message->getMessage()[0])) {
            $type = $this->message->getMessage()[0];
            if ($type == 'A') {
                return $this->message->AMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'B') {
                return $this->message->BMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'C') {
                return $this->message->CMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'D') {
                return $this->message->DMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'E') {
                return $this->message->EMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'F') {
                return $this->message->FMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'G') {
                return $this->message->GMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'H') {
                return $this->message->HMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'I') {
                return $this->message->IMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'J') {
                return $this->message->JMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'K') {
                return $this->message->KMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == '_') {
                return $this->message->_Message($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'L') {
                return $this->message->LMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'M') {
                return $this->message->MMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'N') {
                return $this->message->NMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'R') {
                return $this->message->RMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'S') {
                return $this->message->SMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'T') {
                return $this->message->TMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'V') {
                return $this->message->VMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'W') {
                return $this->message->WMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'X') {
                return $this->message->XMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'Y') {
                return $this->message->YMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'Z') {
                return "<li>None</li>";
            } elseif ($type == 'b') {
                return $this->message->b_Message($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'k') {
                return $this->message->k_Message($this->message->splitString($this->message->getMessage()));
            } elseif ($type == '>') {
                return $this->message->CASMessage($this->message->splitString($this->message->getMessage()));
            } elseif ($type == 'w') {
                return $this->message->w_Message($this->message->splitString($this->message->getMessage()));
            } else {
                return "";
            }
        } else {
            return json_encode(array("error" => "empty message"));
        }
    }
}