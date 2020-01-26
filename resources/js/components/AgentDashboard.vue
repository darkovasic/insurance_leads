<template>
    <form>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">

                <div class="input-group lead-search">
                    <label for="dot_number">DOT Number</label>
                    <input type="text" class="form-control" id="dot_number">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="background:burlywood">Search</button>
                    </span>
                </div>

            </div>

        </div>
        <div class="row" style="background:burlywood">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="person_name">Contact Name</label>
                    <input type="text" class="form-control" id="person_name">
                </div>
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="email" class="form-control" id="email_address">
                </div>
                <div class="form-group">
                    <label for="phy_street">Street</label>
                    <input type="text" class="form-control" id="phy_street">
                </div>
                <div class="form-group">
                    <label for="phy_zip">ZIP Code</label>
                    <input type="text" class="form-control" id="phy_zip">
                </div>
                <div class="form-group">
                    <label for="nbr_power_unit">Number of Trucks</label>
                    <input type="text" class="form-control" id="nbr_power_unit">
                </div>
                <div class="form-group">
                    <label for="last_insurance_carrier">Last Insurance Carrier</label>
                    <input type="text" class="form-control" id="last_insurance_carrier">
                </div>                             
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telephone">Phone Number</label>
                    <input type="text" class="form-control" id="telephone">
                </div>
                <div class="form-group">
                    <label for="dba_name">Company</label>
                    <input type="text" class="form-control" id="dba_name">
                </div>
                <div class="form-group">
                    <label for="phy_city">City</label>
                    <input type="text" class="form-control" id="phy_city">
                </div>
                <div class="form-group">
                    <label for="phy_state">State</label>
                    <input type="text" class="form-control" id="phy_state">
                </div>
                <div class="form-group">
                    <label for="driver_total">Number of Drivers</label>
                    <input type="text" class="form-control" id="driver_total">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description">
                </div>                   
            </div>
        </div>
        <div class="row" style="background:cadetblue">
            <div class="col-md-12">
                <div class="form-group lead-search">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="background:burlywood">Save Changes</button>
                    </span>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" style="background:burlywood">Dispatch</button>
                    </span>
                </div>
            </div>
        </div>        
    </form>

</template>

<script>
    export default {
        mounted() {
            console.log('Agent Dashboard mounted.')
        }
    }
</script>
