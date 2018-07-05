<?php
namespace App\Utils;

use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Filesystem;
use ZipArchive;

class PostcodesGateway
{
    public function updatePostcodesArchive()
    {
        //TODO : Move this URL to config service layer
        $archive = file_get_contents('http://parlvid.mysociety.org/os/codepo_gb-2017-11.zip');
        if (!empty($archive)) {
            $this->writePostcodesArchive($archive);
            $this->decompressPostcodesArchive();
        }
    }

    private function writePostcodesArchive(String $content)
    {
        $fileSystem = new Filesystem();
        try {
            $fileSystem->mkdir(sys_get_temp_dir() . '/postcodes');
            $fileSystem->dumpFile(sys_get_temp_dir() . '/postcodes/postcodes.zip', $content);
        } catch (IOException $exception) {
            echo "Could not create postcode archive at ".$exception->getPath();
        }
    }

    /**
     * Unzip method intentionally abstracted in case the file format changes.
     * @return bool
     */
    private function decompressPostcodesArchive()
    {
        return $this->unzipArchive(sys_get_temp_dir() . '/postcodes/postcodes.zip');
    }

    private function unzipArchive(String $path):bool
    {
        $zip = new ZipArchive;
        if ($zip->open($path) === true) {
            $zip->extractTo(sys_get_temp_dir() . '/postcodes/extracted/');
            $zip->close();
            return true;
        } else {
            return false;
        }
    }

    public function persistPostcodes()
    {
        /*
         * TODO: Iterate through CSVs and map to Postcode objects
         * TODO: Must convert easting and northing to standard lat+lng
         */
    }
}