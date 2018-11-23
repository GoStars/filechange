<?php
    // Change phone field
    // Open input.csv file for read
    $input_handler = fopen('data/input.csv', 'r');
    // Open changedphone.csv file for write
    $changed_phone = fopen('data/changedphone.csv', 'w');
    // Loop through data until end of file
    while (!feof($input_handler)) {
        // Get .scv file
        $line_of_text = fgetcsv($input_handler, 512);
        // Remove everything exept numbers from phone field
        $replaced_phone = str_replace(['+', '-', '(', ')', ' '], '', $line_of_text[6]);
        // Replace existing data with changed one
        $final_phone = str_replace($line_of_text[6], $replaced_phone, $line_of_text);

        // Save changed data in new file
        fputcsv($changed_phone, $final_phone);
    }
    // Close files
    fclose($input_handler);
    fclose($changed_phone);

    // Change date field
    $changed_phone_handler = fopen('data/changedphone.csv', 'r');
    $changed_date = fopen('data/changeddate.csv', 'w');

    while (!feof($changed_phone_handler)) {
        $line_of_text = fgetcsv($changed_phone_handler, 512);
        // Change format of a date 
        // Convert string from file to date format
        $my_date = date("d-m-Y", strtotime($line_of_text[8]));
        $replaced_date = str_replace('-', '.', $my_date);
        $final_date = str_replace($line_of_text[8], $replaced_date, $line_of_text);

        // Save changed data in new file
        fputcsv($changed_date, $final_date);
    }
    // Close files
    fclose($changed_phone_handler);
    fclose($changed_date);

    // Fixing birthday filed not showing properly
    $changed_date_handler = fopen('data/changeddate.csv', 'r');
    $output = fopen('data/output.csv', 'w');

    while (!feof($changed_date_handler)) {
        $line_of_text = fgetcsv($changed_date_handler, 512);
        $replaced = str_replace('01.01.1970', 'birthday', $line_of_text[8]);
        $final = str_replace($line_of_text[8], $replaced, $line_of_text);

        // Save changed data in new file
        fputcsv($output, $final);
    }
    // Close files
    fclose($changed_date_handler);
    fclose($output);


