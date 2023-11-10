<script setup>
import { ref, computed } from "vue"
import { roiPlanData, roiDefaultData } from "./roi/roi-data.js"
import Slider from './roi/Slider.vue'

const hsaSelection = ref(false)
const coinsurance = ref(30)
const deductible = ref(4500)

const updateCoinsurance = (payload) => {
  coinsurance.value = payload.value
}

const updateDeductible = (payload) => {
  deductible.value = payload.value
}

const activePlan = computed(() => {
  const plan = roiPlanData.filter((plan) => {
    return hsaSelection.value ? plan.hsa == hsaSelection.value : plan.hsa == hsaSelection.value && plan.coinsurance == coinsurance.value 
  })
  return plan.length ? plan[0] : roiDefaultData 
})

// dynamically get oopm value 
const activeOOPM = computed(() => { 

  // if HSA, get deductible value 
  if (hsaSelection.value && activePlan.value) { 
    return activePlan.value.plans[deductible.value] ? `$${deductibleFormatted.value}` : '-'
  }

  // if min value is set, do some math 
  if (activePlan.value?.oopm?.min) {
    
    // if deductible x dynamic rate is LESS THAN min, get min value 
    if ((deductible.value * activePlan.value.oopm.dyn) <= activePlan.value.oopm.min) {
      return `$${parseFloat(activePlan.value.oopm.min).toLocaleString("en-US")}`
    }

    // if deductible x dynamic rate is GREATER than max, get max value 
    if ((deductible.value * activePlan.value.oopm.dyn) >= activePlan.value.oopm.max) {
      return `$${parseFloat(activePlan.value.oopm.max).toLocaleString("en-US")}`
    }

    // if deductible falls between min/max values, multiply deductible by dynamic rate 
    return `$${parseFloat(deductible.value * activePlan.value?.oopm?.dyn).toLocaleString("en-US")}`
  }

  // if minimum value is null, just get the OOPM max value 
  return `$${parseFloat(activePlan.value.oopm.max).toLocaleString("en-US")}`
})

const deductibleFormatted = computed(() => parseFloat(deductible.value).toLocaleString("en-US"))
const detailOpen = ref(false)

</script>

<template>

  <div class="planSuggestionModule__module">
    <div class="planSuggestionModule__text">
      <div class="planSuggestionModule__input -checkbox" data-input-type="hsa">
        <h5 class="planSuggestionModule__heading">Are you looking for an HSA-compatible plan? </h5>
        <div class="checkBox radioRadio">
          <div class="checkBox__input">
            <input type="checkbox" id="hsa_plan_yes" class="checkBox__value" name="hsa_plan_select" value="HSA" v-model="hsaSelection" >
            <label for="hsa_plan_yes" class="checkBox__label"><span>Yes</span></label>
          </div>
        </div>
      </div>
      <div class="planSuggestionModule__input -deductible" data-input-type="deductible">
        <h5 class="planSuggestionModule__heading">How much do you want employees to pay for a deductible?</h5>
        <p class="planSuggestionModule__copy">The deductible is the amount employees must pay each plan year in medical expenses before coinsurance kicks in.</p>
        <Slider @update-slider="updateDeductible" :slider-start="deductible" :slider-min="0" :slider-max="9000" :slider-step="500" :dollar-format="true" />
      </div>
      <div class="planSuggestionModule__input -coinsurance" data-input-type="coinsurance" :disabled="hsaSelection" :tabindex="!activePlan.plans[deductible] ? -1 : 0">
        <h5 class="planSuggestionModule__heading">How much coinsurance do you want employees to pay?</h5>
        <p class="planSuggestionModule__copy">Coinsurance is the amount employees must pay for covered care after they reach their deductible and before they reach their out-of-pocket max.</p>
        <Slider @update-slider="updateCoinsurance" :slider-start="coinsurance" :slider-min="10" :slider-max="50" :slider-step="10" />
      </div>
    </div>
    <div class="planSuggestionModule__cardWrap">
      <div class="planSuggestionModule__null" :disabled="!activePlan.plans[deductible]">
        <div class="planSuggestionModule__null-inner">         
          <div class="planSuggestionModule__null-message">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M24 2C24.7575 2 25.4501 2.428 25.7889 3.10557L45.7889 43.1056C46.0988 43.7255 46.0657 44.4618 45.7013 45.0515C45.3369 45.6411 44.6932 46 44 46H4C3.30685 46 2.66311 45.6411 2.2987 45.0515C1.93429 44.4618 1.90116 43.7255 2.21115 43.1056L22.2111 3.10557C22.5499 2.428 23.2425 2 24 2ZM7.23607 42H40.7639L24 8.47214L7.23607 42Z" fill="#9E5601"/><path fill-rule="evenodd" clip-rule="evenodd" d="M24 18C25.1046 18 26 18.8954 26 20V30C26 31.1046 25.1046 32 24 32C22.8954 32 22 31.1046 22 30V20C22 18.8954 22.8954 18 24 18Z" fill="#9E5601"/><path fill-rule="evenodd" clip-rule="evenodd" d="M22 37C22 35.8955 22.8955 35 24 35C25.1045 35 26 35.8955 26 37C26 38.1045 25.1045 39 24 39C22.8955 39 22 38.1045 22 37Z" fill="#9E5601"/></svg>
            <div><span v-if="hsaSelection">HSA-compatible plans </span> <span v-else>Plans with this coinsurance level </span> must have a deductible between {{ `$${activePlan.features.minVal}` }} and {{ `$${activePlan.features.maxVal}` }}</div>
          </div>
        </div>
      </div>
      <div class="planSuggestionModule__card">
        <div class="planSuggestionModule__cardInner">
          <div class="planSuggestionModule__cardContent" :disabled="!activePlan.plans[deductible]">
            <p class="planSuggestionModule__cardIntro">Recommended plan for you: </p>
            <div class="planSuggestionModule__planName">
              {{ activePlan.plans[deductible] ?? 'N/A' }}
            </div>
            <div class="planSuggestionModule__planType">
              {{ hsaSelection ? "PPO Plus HSA" : "PPO Plus" }}
              <div class="planSuggestionModule__planSubType">
                {{ activePlan.type }}
              </div>
            </div>
            <div class="planSuggestionModule__planStats">
              <div class="planSuggestionModule__planStats-value">{{ activePlan.plans[deductible] ? `${activePlan.coinsurance}%` : '-' }}</div>
              <div>Coinsurance</div>
            </div>
            <div class="planSuggestionModule__planStats">
              <div class="planSuggestionModule__planStats-value">{{ activePlan.plans[deductible] ? `$${deductibleFormatted}` : '-' }}</div>
              <div>Deductible</div>
            </div>
            <div class="planSuggestionModule__planStats">
              <div class="planSuggestionModule__planStats-value">
                <span>{{ activeOOPM }}</span>
              </div>
              <div>Out-of-Pocket Max</div>
            </div>
            <p class="planSuggestionModule__planQuoteCopy">Want this plan?</p>
            <a class="button" href="/get-quote/" :tabindex="!activePlan.plans[deductible] ? -1 : 0">Get a quote</a>
          </div>
        </div>
      </div>
      <button class="planSuggestionModule__toggle" @click="detailOpen=!detailOpen">
        <span class="planSuggestionModule__toggleText">{{ detailOpen ? "Hide" : "View" }} plan details </span> 
        <span id="planSuggestionModule__toggleIcon" class="icon-chevron-down planSuggestionModule__toggleIcon" :aria-expanded="detailOpen"></span>
      </button>
    </div>
  </div>

  <div class="planSuggestionModule__detail" :aria-expanded="detailOpen">
    <div class="arrow-up"></div>
    <div class="planSuggestionModule__detailRow">
      <div class="planSuggestionModule__detailCard -order1">
        <div class="planSuggestionModule__detailCard-title">Preventive Care</div>
        <div v-if="activePlan.features.preventativecare==true" class="planSuggestionModule__detailCard-detail"><span class="icon-green-check"></span></div>
        <div v-else class="planSuggestionModule__detailCard-detail"><span class="icon-grey-x"></span></div>
      </div>
      <div class="planSuggestionModule__detailCard -order2">
        <div class="planSuggestionModule__detailCard-title">Virtual Care</div>
        <div v-if="activePlan.features.virtualcare==true" class="planSuggestionModule__detailCard-detail"><span class="icon-green-check"></span></div>
        <div v-else class="planSuggestionModule__detailCard-detail"><span class="icon-grey-x"></span></div>
      </div>
      <div class="planSuggestionModule__detailCard -order3">
        <div class="planSuggestionModule__detailCard-title">Primary Care</div>
        <span class="planSuggestionModule__detailCard-detail">{{ `${activePlan.features.primarycare}` }} </span>
      </div>
      <div class="planSuggestionModule__detailCard -order4">
        <div class="planSuggestionModule__detailCard-title">Specialty Care</div>
        <span class="planSuggestionModule__detailCard-detail">{{ `${activePlan.features.specialtycare}` }} </span>
      </div>
      <div class="planSuggestionModule__detailCard -order5">
        <div class="planSuggestionModule__detailCard-title">RX Coverage</div>
        <div v-if="activePlan.features.rxcoverage==true" class="planSuggestionModule__detailCard-detail"><span class="icon-green-check"></span></div>
        <div v-else class="planSuggestionModule__detailCard-detail"><span class="icon-grey-x"></span></div>
      </div>
      <div class="planSuggestionModule__detailCard -order6">
        <div class="planSuggestionModule__detailCard-title">HSA Compatible</div>
        <div v-if="activePlan.features.hsacompatible==true" class="planSuggestionModule__detailCard-detail"><span class="icon-green-check"></span></div>
        <div v-else class="planSuggestionModule__detailCard-detail"><span class="icon-grey-x"></span></div>
      </div>
      <div class="planSuggestionModule__detailCard -order7">
        <div class="planSuggestionModule__detailCard-title">Physical & Massage Therapy</div>
        <span class="planSuggestionModule__detailCard-detail">{{ `${activePlan.features.physicaltherapy}` }} </span>  
      </div>
      <div class="planSuggestionModule__detailCard -order8">
        <div class="planSuggestionModule__detailCard-title">Chiropractic</div>
        <span class="planSuggestionModule__detailCard-detail">{{ `${activePlan.features.chiropractic}` }} </span>  
      </div>
    </div>
  </div>

</template>
