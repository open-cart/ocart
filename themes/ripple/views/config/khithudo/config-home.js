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

const configMenuFooter = {
    "data": [
        {
            "title": "Sản phẩm",
            "menu": [
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
            "title": "Tin tức",
            "menu": [
                {
                    "name":"Hoạt động của công ty",
                    "slug":"/khicongnghiep",
                },
                {
                    "name":"Kiến thức ngành khí",
                    "slug":"/khicongnghiep",
                },
                {
                    "name":"Ứng dụng khí",
                    "slug":"#",
                },
                {
                    "name":"Các kiến thức khác",
                    "slug":"#",
                },
            ]
        },
        {
            "title": "Liên kết",
            "menu": [
                {
                    "name": "Trang chủ",
                    "slug": "#"
                },
                {
                    "name": "Giới thiệu",
                    "slug": "#"
                },
                {
                    "name": "Liên hệ",
                    "slug": "#"
                },
                {
                    "name": "Facebook",
                    "slug": "#"
                },
                {
                    "name": "Zalo",
                    "slug": "#"
                },
            ]
        }
    ]
}

console.log(JSON.stringify(configMenuFooter))
