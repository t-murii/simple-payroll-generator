<?php include 'header.php'; ?>

<?php
$sql = 'SELECT * FROM payrolls LEFT JOIN employees ON payrolls.employee_id = employees.emp_id WHERE month="MARCH 2022"';
$result = mysqli_query($conn, $sql);
$payrolls = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (empty($payrolls)) : ?>
    <p>There is no payroll selected</p>
<?php endif; ?>


<table class="table" id='table'>
    <thead>
        <tr>
            <th scope="col"> Employee </th>
            <th scope="col"> Id No </th>
            <th scope="col"> Department </th>
            <th scope="col"> Description </th>
            <th scope="col"> Basic Salary </th>
            <th scope="col"> Pastor </th>
            <th scope="col"> Resp </th>
            <th scope="col"> Trustee </th>
            <th scope="col"> Transport </th>
            <th scope="col"> Risk </th>
            <th scope="col"> Communication </th>
            <th scope="col"> water_allow </th>
            <th scope="col"> elec_allow </th>
            <th scope="col"> house_allow </th>
            <th scope="col"> car_maintenance </th>
            <th scope="col"> Total payments </th>
            <th scope="col"> hospitality_allow </th>
            <th scope="col"> NSSF </th>
            <th scope="col"> NHIF </th>
            <th scope="col"> PSSSF </th>
            <th scope="col"> Pension </th>
            <th scope="col"> Loan </th>
            <th scope="col"> Saccos </th>
            <th scope="col"> HESLB </th>
            <th scope="col"> GROSS PAY </th>
            <th scope="col"> PAYE </th>
            <th scope="col"> taxable_total </th>
            <th scope="col"> total_deduction </th>
            <th scope="col"> total_net_pay </th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($payrolls as $payroll) :
            $total_payments = $payroll['basic_salary'] + $payroll['pastor_allow'] + $payroll['resp_allow'] + $payroll['trustee_allow']
                + $payroll['transport_allow'] + $payroll['risk_allow'] + $payroll['comm_allow'] + $payroll['water_allow'] + $payroll['elec_allow']
                + $payroll['house_allow'] + $payroll['car_maintenance'];
            $total_allowance = $payroll['hospitality_allow'];
            $gross_pay = $total_payments + $total_allowance;
            $deductions = $payroll['deduc_nssf'] + $payroll['deduc_nhif'] + $payroll['deduc_pssf'] + $payroll['deduc_pension'] + $payroll['deduc_loan']
                + $payroll['deduc_saccos'] + $payroll['deduc_heslb'];
            $taxable_total = $gross_pay - $deductions;

            //tax rates assumed at a constant rate of 20%
            $paye = $taxable_total * 0.2;
            $total_deduction = $paye + $deductions;
            $total_net_pay = $total_payments - $total_deduction;

            ?>
            <tr>
                <th scope="row"> <?php echo $payroll['emp_name'] ?> </th>
                <td> <?php echo $payroll['emp_id'] ?> </td>
                <td> <?php echo $payroll['department'] ?> </td>
                <td> <?php echo $payroll['description'] ?> </td>
                <td> <?php echo $payroll['basic_salary'] ?> </td>
                <td> <?php echo $payroll['pastor_allow'] ?> </td>
                <td> <?php echo $payroll['resp_allow'] ?> </td>
                <td> <?php echo $payroll['trustee_allow'] ?> </td>
                <td> <?php echo $payroll['transport_allow'] ?> </td>
                <td> <?php echo $payroll['risk_allow'] ?> </td>
                <td> <?php echo $payroll['comm_allow'] ?> </td>
                <td> <?php echo $payroll['water_allow'] ?> </td>
                <td> <?php echo $payroll['elec_allow'] ?> </td>
                <td> <?php echo $payroll['house_allow'] ?> </td>
                <td> <?php echo $payroll['car_maintenance'] ?> </td>
                <td> <?php echo $total_payments ?> </td>
                <td> <?php echo $payroll['hospitality_allow'] ?> </td>
                <td> <?php echo $payroll['deduc_nssf'] ?> </td>
                <td> <?php echo $payroll['deduc_nhif'] ?> </td>
                <td> <?php echo $payroll['deduc_pssf'] ?> </td>
                <td> <?php echo $payroll['deduc_pension'] ?> </td>
                <td> <?php echo $payroll['deduc_loan'] ?> </td>
                <td> <?php echo $payroll['deduc_saccos'] ?> </td>
                <td> <?php echo $payroll['deduc_heslb'] ?> </td>
                <td> <?php echo $gross_pay ?> </td>
                <td> <?php echo $paye ?> </td>
                <td> <?php echo $taxable_total ?> </td>
                <td> <?php echo $total_deduction ?> </td>
                <td> <?php echo $total_net_pay ?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>