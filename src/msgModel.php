<?php

class msgModel
{
    private string $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Hàm nhận vào string chứa message và phân tách thành các trường.
     * @param $inputString . tin nhắn đầu vào.
     * @return array. tin nhắn đã được tách trường.
     */
    public function splitString($inputString): array
    {
        $fields = array();
        $length = strlen($inputString);
        $fields[] = substr($inputString, 0, 1);


        for ($i = 1; $i < $length; $i += 3) {
            $field = substr($inputString, $i, 3);

            $fields[] = $field;
        }

        return $fields;
    }

    public function print(): void
    {
        echo $this->message;
    }

    /**
     * Hàm thêm các ký tự '0' vào chuỗi
     * @param $inputString . chuỗi cần thêm.
     * @param $num . độ dài của chuỗi kết quả.
     * @return mixed|string. chuỗi sau khi thêm
     */
    function changeLength($inputString, $num): mixed
    {
        $length = strlen($inputString);
        while ($length < $num) {
            $inputString .= "0";
            $length++;
        }
        return $inputString;
    }

    /**
     * Hàm phân tích tin nhắn kiểu A.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function AMessage(array $message): string
    {
        $data = [];

        $data[] = [
            "state_type" => "Card Read State",
            "id_of_the_displayed_screen" => $message[1],
            "good_read_next_state" => $message[2],
            "id_of_the_error_screen" => $message[3],
        ];

        $tmp = $this->changeLength((strrev(decbin($message[4]))), 4);

        $arr[] = [
            "value" => $message[4],
        ];

        if ($tmp[0] == '1') {
            $arr[] = [
                "read_track_3" => true,
            ];
        } else {
            $arr[] = [
                "read_track_3" => false,
            ];
        }

        if ($tmp[1] == '1') {
            $arr[] = [
                "read_track_2" => true,
            ];
        } else {
            $arr[] = [
                "read_track_2" => false,
            ];
        }

        if ($tmp[2] == '1') {
            $arr[] = [
                "read_track_1" => true,
            ];
        } else {
            $arr[] = [
                "read_track_1" => false,
            ];
        }

        if ($tmp[3] == '1') {
            $arr[] = [
                "read_smart_data" => true,
            ];
        } else {
            $arr[] = [
                "read_smart_data" => false,
            ];
        }

        $data[] = [
            "read_condition_1" => $arr,
        ];


        $tmp = $this->changeLength((strrev(decbin($message[5]))), 4);
        $arr = array();
        $arr[] = [
            "value" => $message[5],
        ];

        if ($tmp[0] == '1') {
            $arr[] = [
                "read_track_3" => true,
            ];
        } else {
            $arr[] = [
                "read_track_3" => false,
            ];
        }

        if ($tmp[1] == '1') {
            $arr[] = [
                "read_track_2" => true,
            ];
        } else {
            $arr[] = [
                "read_track_2" => false,
            ];
        }

        if ($tmp[2] == '1') {
            $arr[] = [
                "read_track_1" => true,
            ];
        } else {
            $arr[] = [
                "read_track_1" => false,
            ];
        }

        if ($tmp[3] == '1') {
            $arr[] = [
                "read_smart_data" => true,
            ];
        } else {
            $arr[] = [
                "read_smart_data" => false,
            ];
        }

        $data[] = [
            "read_condition_2" => $arr,
        ];


        $tmp = $this->changeLength((strrev(decbin($message[6]))), 4);
        $arr = array();
        $arr[] = [
            "value" => $message[6],
        ];

        if ($tmp[0] == '1') {
            $arr[] = [
                "read_track_3" => true,
            ];
        } else {
            $arr[] = [
                "read_track_3" => false,
            ];
        }

        if ($tmp[1] == '1') {
            $arr[] = [
                "read_track_2" => true,
            ];
        } else {
            $arr[] = [
                "read_track_2" => false,
            ];
        }

        if ($tmp[2] == '1') {
            $arr[] = [
                "read_track_1" => true,
            ];
        } else {
            $arr[] = [
                "read_track_1" => false,
            ];
        }

        if ($tmp[3] == '1') {
            $arr[] = [
                "read_smart_data" => true,
            ];
        } else {
            $arr[] = [
                "read_smart_data" => false,
            ];
        }

        $data[] = [
            "read_condition_3" => $arr,
        ];

        if ($message[7] == '000') {
            $data[] = [
                "card_return_flag" => "Eject the card immediately",
            ];
        } else {
            $data[] = [
                "card_return_flag" => "Return the card as specified by a Transaction",
            ];
        }
        $data[] = [
            "no_fit_match_next_state" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu B.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function BMessage(array $message): string
    {
        $data = [
            "state_type" => "PIN Entry State",
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "local_pin_check_good_pin_next_state" => $message[4],
            "local_pin_check_maximum_bad_pins_next_state" => $message[5],
            "id_of_the_error_screen" => $message[6],
            "remote_pin_check_next_state" => $message[7],
            "local_pin_check_maximum_pin_retries" => intval($message[8]),
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu C.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function CMessage(array $message): string
    {
        $data[] = [
            "state_type" => "Envelope Dispenser State",
            "next_state_number" => $message[1],
            "field_for_reserved_1" => $message[2],
            "field_for_reserved_2" => $message[3],
            "field_for_reserved_3" => $message[4],
            "field_for_reserved_4" => $message[5],
            "field_for_reserved_5" => $message[6],
            "field_for_reserved_6" => $message[7],
            "field_for_reserved_7" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu D.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function DMessage(array $message): string
    {
        $data[] = [
            "state_type" => "Pre-Set Operation Code Buffer State",
            "next_state_number" => $message[1],
            "clear_mask" => $message[2],
            "a_preset_mask" => $message[3],
            "b_preset_mask" => $message[4],
            "c_preset_mask" => $message[5],
            "d_preset_mask" => $message[6],
            "field_for_reserved" => $message[7],
            "extension_state_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu E.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function EMessage(array $message): string
    {
        $data[] = [
            "state_type" => "Four FDK Selection Function State",
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_a_or_i_next_state" => $message[4],
            "fdk_b_or_h_next_state" => $message[5],
            "fdk_c_or_g_next_state" => $message[6],
            "fdk_d_or_f_next_state" => $message[7],
            "keycode_position_in_buffer" => intval($message[8]),
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu F.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function FMessage(array $message): string
    {

        $data[] = [
            "state_type" => "Amount Entry State",
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_a_or_i_next_state" => $message[4],
            "fdk_b_or_h_next_state" => $message[5],
            "fdk_c_or_g_next_state" => $message[6],
            "fdk_d_or_f_next_state" => $message[7],
            "id_of_amount_display_screen_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu G.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function GMessage(array $message): string
    {
        $data[] = [
            "state_type" => "Amount Check State",
            "amount_check_condition_true_next_state" => $message[1],
            "amount_check_condition_false_next_state" => $message[2],
        ];

        $arr[] = [
            "value" => $message[3],
        ];

        if ($message[3] == '000') {
            $arr[] = [
                "buffer_to_be_checked" => 'Amount buffer',
            ];
        } elseif ($message[3] == '001') {
            $arr[] = [
                "buffer_to_be_checked" => 'Buffer B',
            ];
        } elseif ($message[3] == '002') {
            $arr[] = [
                "buffer_to_be_checked" => 'Buffer C',
            ];
        }

        $data[] = [
            "buffer_to_be_checked" => $arr,
            "integer_multiple_value" => intval($message[4]),
            "number_of_decimal_places" => intval($message[5]),
            "currency_type" => intval($message[6]),
            "amount_check_condition" => $message[7],
            "field_for_reserved" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu H.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function HMessage(array $message): string
    {

        $data[] = [
            "state_type" => "Information Entry State",
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_a_or_i_next_state" => $message[4],
            "fdk_b_or_h_next_state" => $message[5],
            "fdk_c_or_g_next_state" => $message[6],
            "fdk_d_or_f_next_state" => $message[7],
        ];

        $arr[] = [
            "value" => $message[8],
        ];

        if ($message[8] == '000') {
            $arr[] = [
                "buffer_and_display_parameters" =>
                    "Display ‘X’ for each numeric key pressed. Store data in general purpose buffer C"
            ];
        } elseif ($message[8] == '001') {
            $arr[] = [
                "buffer_and_display_parameters" =>
                    "Display data as keyed in. Store data in general purpose buffer C"
            ];
        } elseif ($message[8] == '002') {
            $arr[] = [
                "buffer_and_display_parameters" =>
                    "Display ‘X’ for each numeric key pressed. Store data in general purpose buffer B"
            ];
        } elseif ($message[8] == '003') {
            $arr[] = [
                "buffer_and_display_parameters" =>
                    "Display data as keyed in. Store data in general purpose buffer B. Minimum data length is 3 digits"
            ];
        }
        $data[] = [
            "buffer_and_display_parameters" => $arr
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu I.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function IMessage(array $message): string
    {

        $data[] = [
            "state_type" => "Transaction Request State",
            "id_of_the_displayed_screen" => $message[1],
            "central_response_timeout_next_state" => $message[2],
        ];

        if ($message[3] == '000') {
            $tmp = false;
        } elseif ($message[3] == '001') {
            $tmp = true;
        }

        $arr[] = [
            "value" => $message[3],
            "send" => $tmp,
        ];

        $data[] = [
            "send_track_2_data" => $arr];

        if ($message[4] == '000' || $message[4] == '004') {
            $tmp = false;
            $temp = false;
        } elseif ($message[4] == '001' || $message[4] == '005') {
            $tmp = false;
            $temp = true;
        } elseif ($message[4] == '002' || $message[4] == '006') {
            $tmp = true;
            $temp = false;
        } elseif ($message[4] == '003' || $message[4] == '007') {
            $tmp = true;
            $temp = true;
        }

        $arr = array();
        $arr[] = [
            "value" => $message[4],
            "send_track_1" => $tmp,
            "send_track_3" => $temp,
        ];

        $data[] = [
            "send_track_1_and_or_track_3_data" => $arr,];

        $arr = array();

        if ($message[5] == '000') {
            $tmp = false;
        } elseif ($message[5] == '001') {
            $tmp = true;
        }

        $arr[] = [
            "value" => $message[5],
            "send_operation_code_data" => $tmp
        ];

        $data[] = [
            "send_operation_code_data" => $arr];

        $arr = array();

        if ($message[6] == '000') {
            $tmp = false;
        } elseif ($message[6] == '001') {
            $tmp = true;
        }

        $arr[] = [
            "value" => $message[5],
            "send_amount_data" => $tmp
        ];

        $data[] = [
            "send_amount_data" => $arr];

        $arr = array();

        if ($message[7] == '000') {
            $tmp = false;
            $temp = false;
        } elseif ($message[7] == '001') {
            $tmp = false;
            $temp = true;
        } elseif ($message[7] == '128') {
            $tmp = true;
            $temp = false;
        } elseif ($message[7] == '129') {
            $tmp = true;
            $temp = true;
        }

        $arr[] = [
            "value" => $message[7],
            "standard_format" => !$tmp,
            "extended_format" => $tmp,
            "send" => $temp
        ];

        $data[] = [
            "send_pin_buffer_data_or_select_extended_format" => $arr];
        if (intval($message[8]) <= 7) {
            $arr = array();

            if ($message[8] == '000') {
                $tmp = "Send No Buffers";
            } elseif ($message[8] == '001') {
                $tmp = "Send Buffer B";
            } elseif ($message[8] == '002') {
                $tmp = "Send Buffer C";
            } elseif ($message[8] == '003') {
                $tmp = "Send Buffers B and C<";
            } elseif ($message[8] == '004') {
                $tmp = "Reserved";
            }

            $arr[] = [
                "value" => $message[8],
                "purpose" => $tmp
            ];

            $data[] = [
                "send_general_purpose_buffer_B_and/or_C" => $arr];
        } else {
            $data[] = [
                "extension_state_number" => $message[8],
            ];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu J.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function JMessage(array $message): string
    {

        $data[] = [
            "state_type" => "Close State",
            "id_of_receipt_delivered_screen" => $message[1],
            "next_state" => $message[2],
            "id_of_no_receipt_delivered_screen" => $message[3],
            "id_of_card_retained_screen" => $message[4],
            "id_of_statement_delivered_screen" => $message[5],
            "field_for_reserved" => $message[6],
            "id_of_bna_notes_returned_screen" => $message[7],
            "extension_state_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu K.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function KMessage(array $message): string
    {

        $data = [];
        for ($i = 0; $i <= 7; $i++) {
            $data["next_state_{$i}"] = $message[$i + 1];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu _.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function _Message(array $message): string
    {

        $data = [];
        for ($i = 0; $i <= 6; $i++) {
            $data["next_state_{$i}"] = $message[$i + 1];
        }
        $data['extension_state_number'] = $message[8];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu L.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function LMessage(array $message): string
    {

        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "good_write_next_state" => $message[2],
            "bad_write_next_state" => $message[3],
            "no_write_attempted_next_state" => $message[4],
        ];

        for ($i = 5; $i <= 8; $i++) {
            $data["field_for_reserved_" . ($i - 5)] = $message[$i];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu M.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function MMessage(array $message): string
    {

        $arr = [
            "value" => $message[8],
            "local_pin_check_maximum_pin_retries" => intval($message[8]),
        ];

        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "local_pin_check_good_pin_next_state" => $message[4],
            "local_pin_check_maximum_bad_pins_next_state" => $message[5],
            "id_of_the_error_screen" => $message[6],
            "remote_pin_check_next_state" => $message[7],
            "local_pin_check_maximum_pin_retries" => $arr,
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu N.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function NMessage(array $message): string
    {

        $data = [
            "picture_type" => $message[1],
            "next_state" => $message[2],
        ];

        for ($i = 3; $i <= 8; $i++) {
            $data["field_for_reserved_" . ($i - 2)] = $message[$i];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu R.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function RMessage(array $message): string
    {

        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_a_or_i_next_state" => $message[4],
            "fdk_b_or_h_next_state" => $message[5],
            "fdk_c_or_g_next_state" => $message[6],
            "fdk_d_or_f_next_state" => $message[7],
            "extension_state_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu S.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function SMessage(array $message): string
    {

        $data = [
            "no_language_code_next_state" => $message[1],
        ];

        for ($i = 2; $i <= 7; $i++) {
            $data["language_code_" . ($i - 2) . "_next_state"] = $message[$i];
        }

        $data['extension_state_number'] = $message[8];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu T.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function TMessage(array $message): string
    {
        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "good_read_next_state" => $message[2],
            "id_of_the_error_screen" => $message[3],
        ];

        for ($i = 4; $i <= 6; $i++) {
            $arr = array();
            $tmp = $this->changeLength(strrev(decbin($message[$i])), 4);
            $arr = [
                "value" => $message[$i]
            ];

            if ($tmp[0] == '1') {
                $arr["read_condition_" . $i - 3] = "Read Track 3";
            }
            if ($tmp[1] == '1') {
                $arr["read_condition_" . $i - 3] = "Read Track 2";
            }
            if ($tmp[2] == '1') {
                $arr["read_condition_" . $i - 3] = "Read Track 1";
            }
            if ($tmp[3] == '1') {
                $arr["read_condition_" . $i - 3] = "Chip connect - read smart data";
            }

            $data["read_condition_" . $i - 3] = $arr;
        }

        $data['field_for_reserved'] = $message[7];
        $data['extension_state_number'] = $message[8];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu V.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function VMessage(array $message): string
    {

        $data = [
            "next_state" => $message[1],
        ];

        for ($i = 2; $i <= 7; $i++) {
            $data["language_code_for_screen_group_" . ($i - 1)] = $message[$i];
        }

        $data['screen_group_size'] = $message[8];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu W.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function WMessage(array $message): string
    {

        $data = [
            "fdk_a_next_state_number" => $message[1],
            "fdk_b_next_state_number" => $message[2],
            "fdk_c_next_state_number" => $message[3],
            "fdk_d_next_state_number" => $message[4],
            "fdk_f_next_state_number" => $message[5],
            "fdk_g_next_state_number" => $message[6],
            "fdk_h_next_state_number" => $message[7],
            "fdk_i_next_state_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu X.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function XMessage(array $message): string
    {

        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_next_state" => $message[4],
            "extension_state_number" => $message[5],
        ];

        $arr = array(
            "value" => $message[6]
        );

        if ($message[6][1] == '1') {
            $arr["buffer_id"] = "General purpose buffer B";
        } elseif ($message[6][1] == '2') {
            $arr["buffer_id"] = "General purpose buffer C";
        } elseif ($message[6][1] == '3') {
            $arr["buffer_id"] = "Amount buffer";
        }

        $data["buffer_id"] = $arr;

        $data = [
            "fdks_active_mask" => [
                "value" => $message[7],
                "fdk_a_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[0] == '1',
                "fdk_b_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[1] == '1',
                "fdk_c_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[2] == '1',
                "fdk_d_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[3] == '1',
                "fdk_f_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[4] == '1',
                "fdk_g_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[5] == '1',
                "fdk_h_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[6] == '1',
                "fdk_i_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[7] == '1',
            ],
            "field_for_reserved" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Y.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function YMessage(array $message): string
    {

        $data = [
            "id_of_the_displayed_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "fdk_next_state" => $message[4],
            "extension_state_number" => $message[5],

            "buffer_positions" => [
                "value" => $message[6],
                "operation_code_buffer_position" => [
                    "symbol_0" => $message[6][0],
                    "symbol_1" => $message[6][1],
                    "symbol_2" => $message[6][2],
                ],
            ],

            "fdks_active_mask" => [
                "value" => $message[7],
                "fdk_a_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[0] == '1',
                "fdk_b_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[1] == '1',
                "fdk_c_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[2] == '1',
                "fdk_d_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[3] == '1',
                "fdk_f_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[4] == '1',
                "fdk_g_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[5] == '1',
                "fdk_h_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[6] == '1',
                "fdk_i_is_active" => $this->changeLength((strrev(decbin($message[7]))), 8)[7] == '1',
            ],
            "multi_language_screens_selection_extension_state" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu b.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function b_Message(array $message): string
    {

        $data = [
            "id_of_first_entry_screen" => $message[1],
            "timeout_next_state" => $message[2],
            "cancel_next_state" => $message[3],
            "good_next_state" => $message[4],
            "csp_fail_next_state" => $message[5],
            "id_of_second_entry_screen" => $message[6],
            "id_of_mis_match_first_entry_screen" => $message[7],
            "extension_state_number" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu k.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function k_Message(array $message): string
    {

        $data = [
            "field_for_reserved_1" => $message[1],
            "good_read_next_state" => $message[2],
            "field_for_reserved_2" => $message[3],
            "field_for_reserved_3" => $message[4],
            "field_for_reserved_4" => $message[5],
            "field_for_reserved_5" => $message[6],
        ];

        if ($message[7] == '000') {
            $tmp = "Eject the card immediately";
        } elseif ($message[7] == '001') {
            $tmp = "Return the card as specified by a Transaction Reply message";
        }

        $data = [
            "card_return_flag" => [
                "value" => $message[7],
                "card_return_flag" => $tmp
            ]
        ];

        if ($message[7] == '000') {
            $data = [
                "no_fit_match_next_state_number" => [
                    "value" => $message[8],
                    "no_fit_match_next_state_number" => "FITs are not used"
                ]
            ];
        } else {
            $data = [
                "no_fit_match_next_state_number" => [
                    "value" => $message[8],
                    "no_fit_match_next_state_number" => "FITs are used"
                ]
            ];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu >.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function CASMessage(array $message): string
    {

        $data = [
            "cancel_key_mask" => $this->changeLength((strrev(decbin($message[1]))), 8),
            "deposit_key_mask" => $this->changeLength((strrev(decbin($message[2]))), 8),
            "add_more_key_mask" => $this->changeLength((strrev(decbin($message[3]))), 8),
            "refund_key_mask" => $this->changeLength((strrev(decbin($message[4]))), 8),
            "extension_state_1" => $message[5],
            "extension_state_2" => $message[6],
            "extension_state_3" => $message[7],
            "extension_state_4" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu w.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function w_Message(array $message): string
    {
        $arr = array();

        $data = [
            "field_for_reserved" => $message[1],
        ];

        $arr["value"] = $message[2];

        if ($message[2] === '000') {
            $arr["leave_capture_option_description"] = 'Leave at throat';
        } elseif ($message[2] === '001') {
            $arr["leave_capture_option_description"] = 'Capture unacceptable cheque to bin 1';
        } else {
            $arr["leave_capture_option_description"] = 'Unknown leave/capture option';
        }

        $data = [
            "leave_capture_option" => $arr
        ];

        $arr = array();

        $arr["value"] = $message[3];
        if ($message[3] === '000') {
            $arr["cheque_entry_retries_description"] = 'Do not allow cardholder retries';
        } elseif ($message[3] === '001') {
            $arr["cheque_entry_retries_description"] = 'Allow one further retry following initial rejection';
        } elseif ($message[3] === '002') {
            $arr["cheque_entry_retries_description"] = 'Allow two further retries';
        } elseif ($message[3] === '003') {
            $arr["cheque_entry_retries_description"] = 'Allow three further retries';
        } else {
            $arr["cheque_entry_retries_description"] = 'Unknown cheque entry retries';
        }

        $data = [
            "cheque_entry_retries" => $arr
        ];

        $data = [
            "image_lift" => $message[4],
        ];

        $arr = array();

        $arr["value"] = $message[4];
        if ($message[4] === '000') {
            $arr["image_lift_description"] = 'No cheque images are lifted';
        } elseif ($message[4] === '001') {
            $arr["image_lift_description"] = 'An image of the cheque is produced which is suitable for display';
        } else {
            $arr["image_lift_description"] = 'Unknown image lift option';
        }

        $data = [
            "image_lift" => $arr,
            "extension_state_1" => $message[5],
            "extension_state_2" => $message[6],
        ];

        $tmp = $this->changeLength((strrev(decbin($message[7]))), 8);

        $arr = array();

        $arr = [
            "value" => $message[8],
            "fdk_a_is_active" => $tmp[0] === '1',
            "fdk_b_is_active" => $tmp[1] === '1',
            "fdk_c_is_active" => $tmp[2] === '1',
            "fdk_d_is_active" => $tmp[3] === '1',
            "fdk_f_is_active" => $tmp[4] === '1',
            "fdk_g_is_active" => $tmp[5] === '1',
            "fdk_h_is_active" => $tmp[6] === '1',
            "fdk_i_is_active" => $tmp[7] === '1',
        ];

        $data = [
            "cancel_key_mask" => $arr
        ];

        $tmp = $this->changeLength((strrev(decbin($message[8]))), 8);

        $arr = array();

        $arr = [
            "value" => $message[8],
            "fdk_a_is_active" => $tmp[0] === '1',
            "fdk_b_is_active" => $tmp[1] === '1',
            "fdk_c_is_active" => $tmp[2] === '1',
            "fdk_d_is_active" => $tmp[3] === '1',
            "fdk_f_is_active" => $tmp[4] === '1',
            "fdk_g_is_active" => $tmp[5] === '1',
            "fdk_h_is_active" => $tmp[6] === '1',
            "fdk_i_is_active" => $tmp[7] === '1',
        ];

        $data = [
            "deposit_key_mask" => $arr
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho D.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function ZDMessage(array $message): string
    {

        $data = [
            "state_type" => "Extension to State D",
            "f_pre_set_mask" => $message[1],
            "g_pre_set_mask" => $message[2],
            "h_pre_set_mask" => $message[3],
            "i_pre_set_mask" => $message[4],
        ];

        for ($i = 5; $i <= 8; $i++) {
            $data["field_for_reserved"][$i - 5] = $message[$i];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho I.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function ZIMessage(array $message): string
    {

        $data = [
            "state_type" => "Extension to State D",
        ];

        $arr = array();

        $arr = [
            "value" => $message[1]
        ];

        if ($message[1] == '000') {
            $arr["send_buffer_b"] = false;
            $arr["send_buffer_c"] = false;
        } elseif ($message[1] == '001') {
            $arr["send_buffer_b"] = true;
            $arr["send_buffer_c"] = false;
        } elseif ($message[1] == '002') {
            $arr["send_buffer_b"] = false;
            $arr["send_buffer_c"] = true;
        } elseif ($message[1] == '003') {
            $arr["send_buffer_b"] = true;
            $arr["send_buffer_c"] = true;
        }

        $data = [
            "send_general_purpose_buffers_b_and_or_c" => $arr
        ];

        $arr = array();

        $arr = [
            "value" => $message[2],
            "data_to_be_sent" => [
                "a_data_field_is_sent" => false,
                "b_data_field_is_sent" => false,
                "c_data_field_is_sent" => false,
                "d_data_field_is_sent" => false,
                "e_data_field_is_sent" => false,
                "f_data_field_is_sent" => false,
                "g_data_field_is_sent" => false,
                "h_data_field_is_sent" => false,
            ],
        ];

        $tmp = strrev($this->changeLength(strrev(decbin($message[2])), 8));

        if ($tmp[0] == '1') {
            $arr["data_to_be_sent"]["a_data_field_is_sent"] = true;
        } elseif ($tmp[1] == '1') {
            $arr["data_to_be_sent"]["b_data_field_is_sent"] = true;
        } elseif ($tmp[2] == '1') {
            $arr["data_to_be_sent"]["c_data_field_is_sent"] = true;
        } elseif ($tmp[3] == '1') {
            $arr["data_to_be_sent"]["d_data_field_is_sent"] = true;
        } elseif ($tmp[4] == '1') {
            $arr["data_to_be_sent"]["f_data_field_is_sent"] = true;
        } elseif ($tmp[5] == '1') {
            $arr["data_to_be_sent"]["g_data_field_is_sent"] = true;
        } elseif ($tmp[6] == '1') {
            $arr["data_to_be_sent"]["h_data_field_is_sent"] = true;
        } elseif ($tmp[7] == '1') {
            $arr["data_to_be_sent"]["i_data_field_is_sent"] = true;
        }

        $data = [
            "data_to_be_sent_a_to_h" => $arr
        ];

        $arr = array();

        $arr = [
            "value" => $message[3],
            "data_to_be_sent" => [
                "i_data_field_is_sent" => false,
                "j_data_field_is_sent" => false,
                "k_data_field_is_sent" => false,
                "l_data_field_is_sent" => false,
                "m_data_field_is_sent" => false,
                "n_data_field_is_sent" => false,
                "o_data_field_is_sent" => false,
                "p_data_field_is_sent" => false,
            ],
        ];

        $tmp = strrev($this->changeLength(strrev(decbin($message[3])), 8));

        if ($tmp[0] == '1') {
            $arr["data_to_be_sent"]["i_data_field_is_sent"] = true;
        } elseif ($tmp[1] == '1') {
            $arr["data_to_be_sent"]["j_data_field_is_sent"] = true;
        } elseif ($tmp[2] == '1') {
            $arr["data_to_be_sent"]["k_data_field_is_sent"] = true;
        } elseif ($tmp[3] == '1') {
            $arr["data_to_be_sent"]["l_data_field_is_sent"] = true;
        } elseif ($tmp[4] == '1') {
            $arr["data_to_be_sent"]["m_data_field_is_sent"] = true;
        } elseif ($tmp[5] == '1') {
            $arr["data_to_be_sent"]["n_data_field_is_sent"] = true;
        } elseif ($tmp[6] == '1') {
            $arr["data_to_be_sent"]["o_data_field_is_sent"] = true;
        } elseif ($tmp[7] == '1') {
            $arr["data_to_be_sent"]["p_data_field_is_sent"] = true;
        }

        $data = [
            "data_to_be_sent_i_to_p" => $arr
        ];

        $arr = array();

        $arr = [
            "value" => $message[4],
            "data_to_be_sent" => [
                "q_data_field_is_sent" => false,
                "r_data_field_is_sent" => false,
                "s_data_field_is_sent" => false,
                "t_data_field_is_sent" => false,
                "u_data_field_is_sent" => false,
                "v_data_field_is_sent" => false,
                "_w_data_field_is_sent" => false,
                "_a_data_field_is_sent" => false,
            ],
        ];

        $tmp = strrev($this->changeLength(strrev(decbin($message[4])), 8));

        if ($tmp[0] == '1') {
            $arr["data_to_be_sent"]["q_data_field_is_sent"] = true;
        } elseif ($tmp[1] == '1') {
            $arr["data_to_be_sent"]["r_data_field_is_sent"] = true;
        } elseif ($tmp[2] == '1') {
            $arr["data_to_be_sent"]["s_data_field_is_sent"] = true;
        } elseif ($tmp[3] == '1') {
            $arr["data_to_be_sent"]["t_data_field_is_sent"] = true;
        } elseif ($tmp[4] == '1') {
            $arr["data_to_be_sent"]["u_data_field_is_sent"] = true;
        } elseif ($tmp[5] == '1') {
            $arr["data_to_be_sent"]["v_data_field_is_sent"] = true;
        } elseif ($tmp[6] == '1') {
            $arr["data_to_be_sent"]["_w_data_field_is_sent"] = true;
        } elseif ($tmp[7] == '1') {
            $arr["data_to_be_sent"]["_a_data_field_is_sent"] = true;
        }

        $data = [
            "data_to_be_sent_q_to__a" => $arr
        ];

        $arr = array();

        $arr = [
            "value" => $message[5],
            "data_to_be_sent" => [
                "user_data_field_is_sent" => false,
                "_b_data_field_is_sent" => false,
                "reserved_1_data_field_is_sent" => false,
                "reserved_2_data_field_is_sent" => false,
                "_e_data_field_is_sent" => false,
                "reserved_3_data_field_is_sent" => false,
                "reserved_4_data_field_is_sent" => false,
                "reserved_5_data_field_is_sent" => false,
            ],
        ];

        $tmp = strrev($this->changeLength(strrev(decbin($message[5])), 8));

        if ($tmp[0] == '1') {
            $arr["data_to_be_sent"]["user_data_field_is_sent"] = true;
        } elseif ($tmp[1] == '1') {
            $arr["data_to_be_sent"]["_b_data_field_is_sent"] = true;
        } elseif ($tmp[2] == '1') {
            $arr["data_to_be_sent"]["reserved_1_data_field_is_sent"] = true;
        } elseif ($tmp[3] == '1') {
            $arr["data_to_be_sent"]["reserved_2_data_field_is_sent"] = true;
        } elseif ($tmp[4] == '1') {
            $arr["data_to_be_sent"]["_e_data_field_is_sent"] = true;
        } elseif ($tmp[5] == '1') {
            $arr["data_to_be_sent"]["reserved_3_data_field_is_sent"] = true;
        } elseif ($tmp[6] == '1') {
            $arr["data_to_be_sent"]["reserved_4_data_field_is_sent"] = true;
        } elseif ($tmp[7] == '1') {
            $arr["data_to_be_sent"]["reserved_5_data_field_is_sent"] = true;
        }

        $data = [
            "data_to_be_sent" => $arr,
            "field_for_reserved" => $message[6]
        ];

        if ($message[7] == '000') {
            $data = [
                "emv_cam_processing_flag" => array(
                    "emv_cam_processing_flag" => $message[7],
                    "emv_cam_processing_flag_description" => "Do not perform EMV CAM processing"
                )
            ];
        } elseif ($message[7] == '001') {
            $data = [
                "emv_cam_processing_flag" => array(
                    "emv_cam_processing_flag" => $message[7],
                    "emv_cam_processing_flag_description" => "Perform EMV CAM processing"
                )
            ];
        }

        $data = [
            "field_for_reserved" => $message[8]
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho J.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function ZJMessage(array $message): string
    {
        $data = [
            "state_type" => "Extension to State J",
            "cpm_take_document_screen_number" => $message[1],
            "cpm_document_return_retain_flag" => $message[2],
        ];

        for ($i = 3; $i <= 6; $i++) {
            $data["field_for_reserved"] = $message[$i + 1];
        }

        $data = [
            "bna_notes_return_retain_leave_flag" => $message[7],
            "field_for_reserved" => $message[8],
        ];

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho _.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function Z_Message(array $message): string
    {
        $data = [
            "state_type" => "Extension to State _",
        ];

        for ($i = 1; $i <= 8; $i++) {
            $data["next_state_{$i}"] = $message[$i];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho R.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function ZRMessage(array $message): string
    {
        $data = [
            "state_type" => "Extension to State R",
        ];

        $arr = array(
            "value" => $message[1]
        );

        if ($message[1] == '000') {
            $arr["document_amount_buffer_description"] = "Amount buffer";
        } elseif ($message[1] == '001') {
            $arr["document_amount_buffer_description"] = "Buffer B";
        } elseif ($message[1] == '002') {
            $arr["document_amount_buffer_description"] = "Buffer C";
        }

        $data = [
            "document_amount_buffer" => $arr,
            "amount_display_screen_number" => $message[2],
            "start_cav_command" => $message[3]
        ];
        $arr = array(
            "value" => $message[4]
        );

        if ($message[4] == '000') {
            $arr["language_dependent_screen_flag_description"] = "Not language dependent";
        } elseif ($message[4] == '001') {
            $arr["language_dependent_screen_flag_description"] = "Language dependent, regardless of language group size";
        }

        $data = [
            "language_dependent_screen_flag" => $arr
        ];

        for ($i = 5; $i <= 8; $i++) {
            $data["field_for_reserved"] = $message[$i];
        }

        return json_encode($data);
    }

    /**
     * Hàm phân tích tin nhắn kiểu Z mở rộng cho S.
     * @param array $message . tin nhắn đầu vào.
     * @return string. chuỗi JSON kết quả.
     */
    public function ZSMessage(array $message): string
    {
        $data = [
            "state_type" => "Extension to State S"];

        for ($i = 1; $i <= 4; $i++) {
            $data["language_code_to_next_state"] = array(
                [
                    "language_code" => $i + 5,
                    "next_state" => $message[$i],
                ]);
        }

        for ($i = 5; $i <= 8; $i++) {
            $data["field_for_reserved"] = $message[$i];
        }

        return json_encode($data);
    }
}