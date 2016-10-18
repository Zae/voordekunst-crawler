#!/usr/bin/env php
<?php
    require_once __DIR__.'/../vendor/autoload.php';

    // parameters
    $dbHost = '';
    $dbName = '';
    $dbUser = '';
    $dbPassword = '';
    $projectSlug = '12345-title-of-project';
    $tableName = 'wp_vdk_projects';

    try {
        // connect to database
        $dsn = sprintf('mysql:host=%s;dbname=%s', $dbHost, $dbName);
        $pdo = new \PDO($dsn, $dbUser, $dbPassword);

        // read project page from Voor de Kunst site
        $reader = new \Vpl\VdkCrawler\Reader\Reader($projectSlug);
        $html = $reader->getPageHtml();

        // crawl data from html
        $crawler = new Vpl\VdkCrawler\Crawler\Crawler();
        $projectData = $crawler->getProjectData($html);

        // save data to database
        $projectRepository = new \Vpl\VdkCrawler\Repository\ProjectRepository($pdo, $tableName);
        $projectRepository->save($projectData);
    } catch (\Exception $e) {
        echo get_class($e) . " - " . $e->getMessage();
            exit(1);
    }

    exit(0);
