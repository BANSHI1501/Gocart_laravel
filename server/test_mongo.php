<?php
$uri = 'mongodb+srv://prasadbanshi2002_db_user:ppPM8UKPVfsSUPgq@cluster0.5eel8xe.mongodb.net/grocart?appName=Cluster0';
try {
    $manager = new MongoDB\Driver\Manager($uri);
    $command = new MongoDB\Driver\Command(['ping' => 1]);
    $manager->executeCommand('admin', $command);
    echo "Connected successfully\n";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
