document.getElementById('ndc-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let ndcMessage = document.getElementById('ndc-message').value;

    fetch('http://localhost/State-Message-API/src/testController.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'ndc_message=' + encodeURIComponent(ndcMessage)
    })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Lỗi khi gửi request. Status code: ' + response.status);
            }
            return response.text();
        })
        .then(function(data) {
            let responseContainer = document.getElementById('responseContainer');
            responseContainer.innerHTML = data;

            const parsedData = JSON.parse(data);

            // Tạo các phần tử HTML từ parsedData
            let htmlContent = '';

            parsedData.forEach(item => {
                for (const key in item) {
                    if (item.hasOwnProperty(key)) {
                        const value = item[key];

                        if (Array.isArray(value)) {
                            // Xử lý trường hợp giá trị là một mảng
                            value.forEach(subItem => {
                                for (const subKey in subItem) {
                                    if (subItem.hasOwnProperty(subKey)) {
                                        htmlContent += `
                                        <div class="attribute-container">
                                            <label for="${key}_${subKey}">${key} ${subKey}:</label>
                                            <input type="text" id="${key}_${subKey}" value="${subItem[subKey]}" readonly>
                                        </div>
                                    `;
                                    }
                                }
                            });
                        } else {
                            // Xử lý trường hợp giá trị không phải mảng
                            htmlContent += `
                            <div>
                                <label for="${key}">${key}:</label>
                                <input type="text" id="${key}" value="${value}" readonly>
                            </div>
                        `;
                        }
                    }
                }
            });

            responseContainer.innerHTML = htmlContent;
        })
        .catch(function(error) {
            console.error(error);
        });
});
