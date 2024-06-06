<?php
// Database connection parameters
$servername = "Localhost";
$username = "id22274749_adminn";
$dbname = "id22274749_gr190011";
$password = "Admin1234&";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the highest salary for each department with department name
$sql = "SELECT e.IDDEPTO, d.NOMDEPTO, MAX(e.SUELDO) AS MAX_SUELDO 
        FROM EMPLEADO e
        INNER JOIN DEPTO d ON e.IDDEPTO = d.IDDEPTO
        GROUP BY e.IDDEPTO";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Array to store results
    $response = array();

    // Fetch data and store it in the response array
    while ($row = $result->fetch_assoc()) {
        $response[] = array(
            'IDDEPTO' => $row['IDDEPTO'],
            'NOMDEPTO' => $row['NOMDEPTO'],
            'MAX_SUELDO' => $row['MAX_SUELDO']
        );
    }

    // Return JSON response
    echo json_encode($response);
} else {
    // If no results found
    echo "No results found";
}

// Close the connection
$conn->close();
?>