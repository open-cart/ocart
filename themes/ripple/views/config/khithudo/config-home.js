const configMenu = {
    "data": [
        {
            "name":"Trang chủ",
            "slug":"/"
        },
        {
            "name":"Sản phẩm",
            "slug":"#",
            "children":[
                {
                    "name":"Khí công nghiệp",
                    "slug":"#",
                },
                {
                    "name":"Khí đặc biệt",
                    "slug":"#",
                },
                {
                    "name":"Khí chuẩn",
                    "slug":"#",
                },
                {
                    "name":"Khí y tế",
                    "slug":"#",
                },
                {
                    "name":"Thiết bị ngành khí",
                    "slug":"#",
                },
                {
                    "name":"Các sản phẩm - dịch vụ khác",
                    "slug":"#",
                }
            ]
        },
        {
            "name":"Tin tức",
            "slug":"#",
            "children":[
                {
                    "name":"Hoạt động của công ty",
                    "slug":"/khicongnghiep",
                },
                {
                    "name":"Kiến thức ngành khí",
                    "slug":"/khicongnghiep",
                    "children": [
                        {
                            "name":"Ứng dụng khí",
                            "slug":"#",
                        },
                        {
                            "name":"Các kiến thức khác",
                            "slug":"#",
                        }
                    ]
                }
            ]
        },
        {
            "name": "Liên hệ",
            "slug": "/about.html"
        }
    ]
}

console.log(JSON.stringify(configMenu))
