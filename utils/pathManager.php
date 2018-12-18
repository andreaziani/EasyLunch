<?php
namespace Utils;
/**
 * Class that manage the path for php files.
 * For a correct usage, create in hodocs the folder "ProgettoTecWeb"
 */
class PathManager
{

    const DIR_ICON = "/images/icon/";
    const DIR_TEMPLATE = "/view/template/";
    const DIR_UPLOAD = "/images/productsimages/";
    public $uploadPath;
    public $iconPath;
    public $webSitePath;
    public $dirUpload;

    public function __construct()
    {
        $this->webSitePath = $_SERVER['DOCUMENT_ROOT'] . '/ProgettoTecWeb/';
        $this->uploadPath = $this->webSitePath . self::DIR_UPLOAD;
        $this->dirUpload = self::DIR_UPLOAD;
        $this->iconPath = $this->webSitePath . self::DIR_ICON;
    }

    /**
     * Require in the page the file written in filePath
     * @param filepath the local path (after "front-end") of the required file
     */
    public function requireFromWebSitePath($filePath)
    {
        require_once $this->webSitePath. self::DIR_TEMPLATE . $filePath;
    }
}
