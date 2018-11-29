<?php
    
    // Open input.csv file for read
    $input_handler = fopen('data/input.csv', 'r');
    // Open output.csv file for write
    $output = fopen('data/output.csv', 'w');

    // Get .scv file
    while (false !== ($line_of_text = fgetcsv($input_handler))) {
        // Change phone field
        // Remove everything exept numbers from phone field
        $replaced_phone = str_replace(['+', '-', '(', ')', ' '], '', $line_of_text[6]);
        // Replace existing data with changed one
        $final_phone = str_replace($line_of_text[6], $replaced_phone, $line_of_text);

        // Change format of a date 
        // Convert string from file to date format
        $my_date = date("d-m-Y", strtotime($final_phone[8]));
        $replaced_date = str_replace('-', '.', $my_date);
        $final_date = str_replace($final_phone[8], $replaced_date, $final_phone);

        // Fixing birthday filed not showing properly
        $replaced = str_replace('01.01.1970', 'birthday', $final_date[8]);
        $final = str_replace($final_date[8], $replaced, $final_date);

        // Save changed data in new file
        fputcsv($output, $final);
    }

    // Close files
    fclose($input_handler);
    fclose($output);
