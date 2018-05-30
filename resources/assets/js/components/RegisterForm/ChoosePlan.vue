<template>
    <span>
        <h2>Choose plan</h2>
        <ul class="list-unstyled">
            <li>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h2>Micro</h2>
                        <h3>9,99$</h3>
                        <ul>
                            <li>Benefit #1</li>
                            <li>Benefit #2</li>
                            <li>Benefit #3</li>
                            <li>Benefit #4</li>
                            <li>Benefit #5</li>
                        </ul>
                        <a href="#" @click.prevent="choosePlan('micro')" class="btn btn-primary btn-block">Choose</a>
                    </div>
                </div>
            </li>
            <li>
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <h2>Standard</h2>
                        <h3>99,99$</h3>
                        <ul>
                            <li>Benefit #6</li>
                            <li>Benefit #2</li>
                            <li>Benefit #9</li>
                            <li>Benefit #4</li>
                            <li>Benefit #10</li>
                        </ul>
                        <a href="#" @click.prevent="choosePlan('standard')" class="btn btn-primary btn-block">Choose</a>
                    </div>
                </div>
            </li>
        </ul>
    </span>
</template>

<script>
    export default {
        props:['info'],
        methods:{
            choosePlan(plan){
                this.info.plan = plan
                this.info.currentStep += 1
            }
        }
    }
</script>