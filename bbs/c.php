<section>

    <p style = "text-align:center;font-size:36px;">ゲームタイトル</p>

<div style = "border-bottom:ridge;padding-bottom:60px;">

    <ul style = "margin-top:60px;border:ridge;border-radius:13px;width:666px;
                list-style-type:square;padding:40px;background-color:white;
                margin-left:auto;margin-right:auto;height:300px;font-family:UAの初期値;">
        
        <li style = "list-style:none;font-size:21px;text-decoration:none;text-align:center;">
            
            <?php

                $result = getFullTitle();
                
                $array = array_slice($result,0,100);
                
                foreach($array as $tItem){
                    outThreadLists($tItem);
                }

            ?>
        </li>

    </ul>

</div>
    
</section>
