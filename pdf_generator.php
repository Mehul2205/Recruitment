<?php
include_once('libs/fpdf.php');

require 'server.php';
session_start();

$firstname=$_SESSION['name'];
$lastname=$_SESSION['lastname'];
$department=$_SESSION['department'];
$post=$_SESSION['post'];
$img_url="images/".$_SESSION['id'].".jpg";
if(!file_exists($img_url))
{
    $img_url = "images/generic.jpg";
}
if(isset($_GET['description']))
{
    $sql="DELETE FROM `add_details` WHERE id='".$_SESSION['id']."';";
    $conn->query($sql);
    $description = $_GET['description'];
    $stmt = $conn->prepare("INSERT INTO add_details (id,description) VALUES (?,?)");
    $stmt->bind_param("ss", $_SESSION['id'], $description);
    $stmt->execute();
}

class PDF extends FPDF
{
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$display_heading1 = array('ID', 'placeofbirth', 'marital_status','Nationality','handicapped','religion','blood','mark');

$sql1 ="SELECT * FROM `personaldetails` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);

$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();

$pdf->SetFont('Arial','B',13);
$pdf->Cell(70);
$pdf->Cell(50,10,'Personal Details',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'emergency_phone_number', 'alternate_email');
$sql1 ="SELECT * FROM `contact` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Contacts',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'AddressLine1','AddressLine2', 'City','Pincode','District','State');
$sql1 ="SELECT * FROM `paddress` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Parmanent Address',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'AddressLine1','AddressLine2', 'City','Pincode','District','State');
$sql1 ="SELECT * FROM `caddress` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(55);
$pdf->Cell(60,10,'Correspondance Address',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Exam Name','Discipline/Major', 'Institution','Board','Year Passed','Result Date','Score');
$sql1 ="SELECT * FROM `secondary` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Secondary Eduction',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Exam Name','Discipline/Major', 'Institution','Board','Year Passed','Result Date','Score');
$sql1 ="SELECT * FROM `hsecondary` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(50);
$pdf->Cell(70,10,'Senior Secondary Eduction',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Degree/Programme','Discipline/Major', 'Institution','Board','Year Passed','Result Date','Score');
$sql1 ="SELECT * FROM `bachelor` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Bachelor\'s Degree',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Degree/Programme','Discipline/Major', 'Institution','Board','Year Passed','Result Date','Score');
$sql1 ="SELECT * FROM `masters` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Master\'s Degree',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Thesis Title','Research Area', 'Institution','University','Enrollment Date','Date of Defence','Score');
$sql1 ="SELECT * FROM `phd` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Phd Programme',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID','Degree/Programme','Discipline/Major', 'Institution','University','Year Passed','Result Date','Score');
$sql1 ="SELECT * FROM `other` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Other Degree/Diploma',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'No. of Non-SCI Journals','No. of SCI Journals', 'No. of Non-SCI Journals after PhD','No. of Conference Paper','No.of Book Chapters','No.of Books','No. of Invited Talks');
$sql1 ="SELECT * FROM `psummary` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Publication Summary',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(80,12,$display_head,1,0);
$pdf->MultiCell(100,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Experience after Phd','Experience after M.Tech', 'Experience after PhD in University','No. of ongoing Sponsored Products','No. of completed Sponsored Products','No. of Experiments', 'No. of Academic Outreach Activity');
$sql1 ="SELECT * FROM `expsummary` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Experience Summary',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(80,12,$display_head,1,0);
$pdf->MultiCell(100,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Employer','Address', 'Designation','Employment Type','In Government Sector','In IIIT Nagpur','Joining Date','Leaving Date','Nature of Work','Last Salary Drawn','Basic Pay','GP','Level');
$sql1 ="SELECT * FROM `workexperience` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Work Experience',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Title','Funding Agency', 'Role','Other Investigators','Currency','Cost','Start Date','Completion Date','Outcome of the Project');
$sql1 ="SELECT * FROM `sponsored` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Sponsored Projects',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Award Title','Issuing Agency', 'Date');
$sql1 ="SELECT * FROM `awards` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Awards',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Scolarship Name','Issuing Agency', 'Date');
$sql1 ="SELECT * FROM `scholarships` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Scolarships',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID','Recognition Title','Issuing Agency', 'Date');
$sql1 ="SELECT * FROM `Recognition` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Recognition',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Invention','Short Discription', 'Inventors','Country','Patent Number','Patent Issuing Date','Application Number','Application Date','Status');
$sql1 ="SELECT * FROM `patents` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Patents',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Name','Membership Category', 'Membership Start Date','Membership End Date');
$sql1 ="SELECT * FROM `members` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(50);
$pdf->Cell(70,10,'Member of Professional Bodies',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Bachelor students Supervised','Masters students Supervised', 'PhD students Supervised-Total','PhD students Supervised-Sole','PhD students Supervised-Principal','PhD students Supervised-Continuing');
$sql1 ="SELECT * FROM `supervised` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Students Supervised',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(80,12,$display_head,1,0);
$pdf->MultiCell(100,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Title','Short Discription', 'URL');
$sql1 ="SELECT * FROM `elearning` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Elearning Material',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Name','Phone Number', 'Email-ID','Address');
$sql1 ="SELECT * FROM `references` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Reference',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}


$display_heading1 = array('I','ID', 'Name of Course','Short Description', 'Start Date','End Date');
$sql1 ="SELECT * FROM `stcourses` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Short Term Courses',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('I','ID', 'Name of Course','Short Description', 'Start Date','End Date');
$sql1 ="SELECT * FROM `outreach` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Outreach Activity',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$display_heading1 = array('ID', 'Description');
$sql1 ="SELECT * FROM `add_details` WHERE id='".$_SESSION['id']."';";
$result1 = $conn->query($sql1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(60);
$pdf->Cell(50,10,'Addirional Details',1,0,'C');
$pdf->SetFont('Arial','B',12);

$pdf->Ln(20);
foreach($result1 as $row) {
$pdf->Ln(0);
foreach(array_combine($display_heading1,$row) as $display_head=>$column){
$pdf->Cell(60,12,$display_head,1,0);
$pdf->MultiCell(120,12,$column,1,1);
}
}

$pdf->Output();
?>
