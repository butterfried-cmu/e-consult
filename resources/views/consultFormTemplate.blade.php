<style>
    .table {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 5px 10px;
    }

    .center {
        text-align: center;
    }

    .right {
        text-align: right;
    }

    .left {
        text-align: left;
    }

    #print {
        margin: 0 30px;
    }

    h2 {
        margin-bottom: -10px
    }
</style>

<div id="print">
    <div class="center">
        <br/>
        <h3><b>Doctor's Order Sheet Kokha Hospital</b></h3>
    </div>
    <div class="right">
        <b>consult id:</b> {{ $consult->consult_id }}<br>
        <b>date:</b> {{ $consult->created_at }}<br>
    </div>
    <br/>
    <div>
        <table class="table">
            <tr class="table">
                <th class="table">Patient Name</th>
                <th class="table">Gender</th>
                <th class="table">Date of Birth</th>
                <th class="table">Address</th>
            </tr>
            <tr class="table">
                <td class="table">{{ $consult->patient_firstname }} {{ $consult->patient_lastname }}</td>
                <td class="center table">{{ $consult->patient_gender }}</td>
                <td class="center table">{{ $consult->patient_dob }}</td>
                <td class="table">{{ $consult->patient_address }}</td>
            </tr>
        </table>
    </div>
    <br/>
    <div>
        <table>
            <tr>
                <td><b>Dx:</b></td>
                <td>{{ $consult->med_dx }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td><b>BW:</b></td>
                <td>{{ $consult->med_bw }}</td>

                <td><b>BMI:</b></td>
                <td>{{ $consult->med_bmi }}</td>

                <td><b>T</b></td>
                <td>{{ $consult->med_t }}</td>

                <td><b>FBS:</b></td>
                <td>{{ $consult->med_fbs }}</td>
            </tr>
            <tr>
                <td><b>Cr:</b></td>
                <td>{{ $consult->med_cr }}</td>

                <td><b>Clearance:</b></td>
                <td>{{ $consult->med_clearance }}</td>

                <td><b>Stage:</b></td>
                <td>{{ $consult->med_stage }}</td>
            </tr>
        </table>
    </div>
    <hr/>
    <div>
        <table>
            <tr>
                <td><b>Hx:</b> {{ $consult->rec01_date }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td><b>FBS:</b></td>
                <td>{{ $consult->rec01_fbs }}</td>

                <td><b>BP1:</b></td>
                <td>{{ $consult->rec01_bp1 }}</td>

                <td><b>BP2:</b></td>
                <td>{{ $consult->rec01_bp2 }}</td>

                <td><b>P:</b></td>
                <td>{{ $consult->rec01_p }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td><b>Hx:</b> {{ $consult->rec02_date }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td><b>FBS:</b></td>
                <td>{{ $consult->rec02_fbs }}</td>

                <td><b>BP1:</b></td>
                <td>{{ $consult->rec02_bp1 }}</td>

                <td><b>BP2:</b></td>
                <td>{{ $consult->rec02_bp2 }}</td>

                <td><b>P:</b></td>
                <td>{{ $consult->rec02_p }}</td>
            </tr>
        </table>
        <hr/>
        <table>
            <tr>
                <td><b>Chief Complain:</b></td>
                <td>{{ $consult->consult_complain }}</td>
            </tr>
            <tr>
                <td><b>Assessment and plan:</b></td>
                <td>{{ $consult->consult_plan }}</td>
            </tr>
            <tr>
                <td><b>Consult Order:</b></td>
                <td>{{ $consult->consult_order }}</td>
            </tr>
        </table>
    </div>
</div>
