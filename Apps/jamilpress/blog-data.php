<?php
$BLOG_URL = null;
$BLOG_NAME = null;
$BLOG_DESC = null;
$BLOG_CAT = null;
$BLOG_SUM = null;
$BLOG_LOGO = null;
$BLOG_AUTHOR = null;
$BLOG_OWNER = null;
$BLOG_KEWORDS = null;
$BLOG_DATA = null;
$BLOG_THEME = null;
$BLOG_DATE = null;
$BLOG_ID = null;
if(isset($_SESSION['blog'])){

    $BLOG_URL = $_SESSION['blog'];
    $getblog = new JP_Blog($_SESSION['blog']);
    $BLOG_CAT  = $getblog->getCat();
    $BLOG_NAME = $getblog->getName();
    $BLOG_DESC = $getblog->getContent();
    $BLOG_SUM = $getblog->getSummary();
    $BLOG_LOGO = $getblog->getImage();
    $BLOG_AUTHOR = $getblog->getAuthor();
    $BLOG_OWNER = $getblog->getowner();
    $BLOG_DATA = $getblog->getData();
    $BLOG_THEME = $getblog->getTheme();
    $BLOG_DATE = $getblog->getDate();
    $BLOG_KEWORDS = $getblog->getKeywords();
    $BLOG_ID = $getblog->getId();

}