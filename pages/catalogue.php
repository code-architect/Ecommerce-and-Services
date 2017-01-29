<?php
//check if the category parameter exists or not
$cat = Url::getParam('category');

if(empty($cat))
{
    require_once("error.php");
} else {

    $objCatalogue = new Catalogue();
    $category = $objCatalogue->getCategory($cat);

    // check if there is a category exists or not
    if(empty($category))
    {
        require_once("error.php");
    }else{

        $rows = $objCatalogue->getProducts($cat);

        require_once('_header.php');
?>

    <h1>Catalogue :: <?php echo $category['name']; ?></h1>

    <?php
        // if data exists then do this
        if(!empty($rows))
        {
            foreach($rows as $row)
            {
                ?>
                <div class="catalogue_wrapper">
                    <div class="catalogue_wrapper_left">
                        <?php
                        // if image is not empty, show image
                        $image =!empty($row['image']) ?
                            'media/catalogue/'.$row['image'] :
                            'media/catalogue/unavailable.png';

                        $width = Helper::getImgSize($image, 0);
                        $width = $width > 120 ? 120 : $width;
                        ?>

                        <a href="/?page="></a>
                    </div>
                </div>
                <?php
            }
        }
    ?>

<?php
        require_once('_footer.php');
    }
}

?>

