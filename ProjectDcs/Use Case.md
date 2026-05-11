# Use Cases - ksf_Recruitment

## UC-RE-001: Post Job Opening
**Actor**: HR Manager

**Flow**:
1. Navigate to Recruitment > New Position
2. Enter job details
3. Post to job boards (integration)
4. Create hiring pipeline

## UC-RE-002: Track Applicant
**Actor**: HR, Hiring Manager

**Flow**:
1. Applicant applies (portal/email)
2. System creates applicant record
3. Move through stages:
   - Application → Screening → Interview → Offer → Hired
4. Schedule interviews (ksf_Calendar)
5. Workflow approval for offer (ksf_Workflow)

## UC-RE-003: Convert to Employee
**Actor**: HR Manager

**Trigger**: Offer accepted

**Flow**:
1. Mark candidate as 'Hired'
2. System creates employee in ksf_HRM
3. Triggers ksf_Onboarding
4. Job position updated

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*