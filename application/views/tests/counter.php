<html>
<head>
</head>
<body>
    <span style="background-color: chartreuse">Success : </span><span id="success" style="background-color: chartreuse">0</span><br>
    <span style="background-color: red">Fail : </span><span id="fail" style="background-color: red">0</span>
    <script type="text/javascript" src=<?php echo base_url("assets/js/jquery-2.1.4.min.js")?>></script>
    <script type="text/javascript">
        var success = 0, fail = 0;

        function send_ajax()
        {
            $.ajax({
                type: "POST",
                //url: "<?//php echo base_url("Auth/testAjaxPostgresql"); ?>", // for Pipeline
                url: "<?php echo base_url("Auth/testAjax"); ?>", // for Mysql
                cache: false,
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
                dataType: 'json',
                success: function(json)
                {
                    try
                    {
                        if(json.status = "1")
                        {
                            $('span#success').text(++success);
                        }
                        else
                        {
                            $('span#fail').text(++fail);
                        }
                        console.log(json);
                    }
                    catch(e)
                    {
                        console.log('Exception while request..');
                    }
                },
                error: function(xhr, status, error)
                {
                    console.log('Error: '+ xhr.status+ ' - '+ error);
                }
            });
        }


        setInterval(function()
        {
            send_ajax();
            //$('span#counter').text(++counter);
        },50);
    </script>
</body>
</html>