<?php

require_once('src/msgHandler.php');

function processPostRequest(): void
{
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header('HTTP/1.1 405 Method Not Allowed');
        echo json_encode(array("message" => "Phương thức không được hỗ trợ"));
        return;
    }

    // Lấy dữ liệu POST và trả về phản hồi JSON
    $postData = file_get_contents('php://input');
    $postDataArray = json_decode($postData, true);

    // Tạo đối tượng msgHandler với giá trị của 'ndc_message' từ request
    $ndcMessage = $postDataArray['ndc_message'];
    $handler = new msgHandler($ndcMessage);

    // Phân tích NDC message
    $response = $handler->parse();

    // Trả về phản hồi JSON
    echo json_encode($response);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header('Content-Type: application/json');
    processPostRequest();
}
