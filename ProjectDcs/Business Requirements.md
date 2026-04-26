# Business Requirements - ksf_Recruitment

## Project Overview
Recruitment module - manage hiring requisitions, candidates, interviews, and offers.

## Problem Statement
- Need to track job requisitions
- Manage candidates through pipeline
- Interview scheduling and feedback
- Offer management
- Integration with onboarding

## Scope

### In Scope
1. **Requisitions**
   - Create opening with requirements
   - Department, manager assignment
   - Status (open, filled, cancelled)
   - Priority

2. **Candidates**
   - Apply to requisition
   - Pipeline stages (Applied → Screening → Interview → Offer → Hired/Rejected)
   - Resume/CV storage
   - Notes/history

3. **Interviews**
   - Schedule interviews
   - Rate criteria (1-5)
   - Feedback collection
   - Decision

4. **Offers**
   - Generate offer letter
   - Compensation proposal
   - Acceptance tracking

5. **Integration**
   - Auto-create employee on hire
   - Auto-create onboarding tasks

### Out of Scope
- External job board posting
- Email parsing fromIndeed

## Pipeline Stages
1. Applied
2. Phone Screen
3. Technical Interview
4. Manager Interview
5. HR Interview
6. Offer Extended
7. Hired / Rejected