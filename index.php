<!DOCTYPE html>
<html>
    <head>
        <title>
            Lloyd F. Moss Free Clinic Educational Material Database
        </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
        <style>
            
            body {
                font-family: Arial, sans-serif;
                background-color: #f3f3f3;
                color: #333;
                margin: 0;
            }
            #container {
                max-width: 1200px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                position: relative;
                display: flex;
                flex-direction: column;
                min-height: 500px;
            }
            #appLink:visited {
                color: gray; 
            }
            #content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            #content-inner {
                text-align: center;
                max-width: 800px;
                width: 100%;
            }
            h1 {
                color: #4b6c9e;
                font-size: 36px;
                margin-bottom: 20px;
                text-align: center;
                margin: 0 auto;
            }
            p {
                font-size: 18px;
                line-height: 1.6;
                margin: 0 auto;
            }

            @media (max-width: 480px) {
                #container {
                    max-width: 100%;
                }
                h1 {
                    font-size: 24px;
                }
                p {
                    font-size: 16px;
                    line-height: 1.4;
                }
            }

        </style> 
    </head>
    <body>
        <div id="container">
        <?php include('views/layouts/header.php');?>
            <div id="content">
                <div id="content-inner">
                    <h1>Welcome to the</br>Lloyd F. Moss Free Clinic</br>Database</h1>
                    <p>
                        This is the Lloyd F. Moss Free Clinic Database. It serves to educate patients on their condition or illness. It aims to provide them with addition knowledge so that they can better understand their diagnosis. You can search or browse for educational content. (Click on the handshake image above to get redirected to the Moss Free Clinic homepage).
                    </p>
                </div>
            </div>
            <?php include('views/layouts/footer.php'); ?>
        </div>
    </body>
</html>
