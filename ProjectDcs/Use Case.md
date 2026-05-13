# Use Cases - ksf_Recruitment

## Document Information
- **Module**: ksf_Recruitment
- **Version**: 1.0.0
- **Last Updated**: 2026-05-13
- **Based On**: Business Requirements.md

---

## Use Case 1: Create Job Posting from Job Description

### Actor
HR Manager, Hiring Manager

### Description
The HR Manager or Hiring Manager creates a job posting in the recruitment system based on an internal job description.

### Pre-conditions
- User is authenticated with HR Manager or Hiring Manager role
- Job description exists (internal document or template)
- Required fields are defined in the system configuration

### Steps
1. User navigates to "Create Job Posting" screen
2. System displays job posting form with fields: Title, Department, Location, Employment Type, Salary Range, Description, Requirements, Benefits
3. User enters job title from job description
4. User selects department from dropdown
5. User enters job location
6. User selects employment type (Full-time, Part-time, Contract, Intern)
7. User enters salary range (minimum and maximum)
8. User enters job description (duties and responsibilities)
9. User enters required qualifications and skills
10. User enters benefits information
11. User sets application deadline (optional)
12. User clicks "Save as Draft" or "Publish"
13. System validates all required fields
14. System creates job posting record with status "Draft" or "Published"
15. System displays success confirmation with posting ID

### Post-conditions
- Job posting is created with unique posting ID
- Status is set to "Draft" (if saved) or "Published" (if published)
- Job posting is searchable by candidates
- Audit log entry is created

### Alternative Flows
- **AF1**: User cancels operation
  - At step 12, user clicks "Cancel"
  - System discards all entered data
  - System returns user to previous screen
- **AF2**: Validation failure
  - At step 13, system detects missing required fields
  - System highlights missing fields with error messages
  - User corrects errors and resubmits
- **AF3**: Duplicate posting detected
  - At step 13, system detects similar existing posting
  - System displays warning with duplicate details
  - User confirms creation or modifies details

---

## Use Case 2: Submit Application

### Actor
Job Candidate

### Description
A job candidate submits an application for a published job posting.

### Pre-conditions
- Job posting exists with status "Published"
- Application deadline has not passed
- Candidate account exists or guest application is enabled

### Steps
1. Candidate views published job posting
2. Candidate clicks "Apply Now" button
3. System displays application form
4. Candidate enters personal information (Name, Email, Phone)
5. Candidate uploads resume (PDF, DOC, DOCX - max 5MB)
6. Candidate uploads cover letter (optional)
7. Candidate answers screening questions (if defined)
8. Candidate enters work history (optional via profile)
9. Candidate enters education details (optional via profile)
10. Candidate reviews all entered information
11. Candidate clicks "Submit Application"
12. System validates all required fields and file uploads
13. System creates application record linked to job posting
14. System sends confirmation email to candidate
15. System displays submission confirmation screen

### Post-conditions
- Application record is created with unique application ID
- Application status is set to "Submitted"
- Candidate receives confirmation email with application ID
- Hiring managers receive notification of new application
- Application appears in applicant tracking list

### Alternative Flows
- **AF1**: Candidate cancels application
  - At step 11, candidate clicks "Save and Exit"
  - System saves draft application
  - Candidate can resume later from saved drafts
- **AF2**: File upload failure
  - At step 5 or 6, file exceeds size limit or invalid format
  - System displays error message
  - Candidate removes file and re-uploads valid file
- **AF3**: Duplicate application detected
  - At step 13, system detects existing application from same candidate
  - System displays warning message
  - Candidate can view existing application or cancel
- **AF4**: Application deadline passed
  - At step 2, posting deadline has passed
  - System displays "Application Closed" message
  - Apply button is disabled

---

## Use Case 3: Review Applications

### Actor
HR Manager, Hiring Manager

### Description
HR Manager or Hiring Manager reviews submitted applications for a job posting to shortlist candidates.

### Pre-conditions
- User is authenticated with HR Manager or Hiring Manager role
- At least one application exists for the job posting
- User has access to the job posting

### Steps
1. User navigates to "Applications" section
2. System displays list of applications filtered by job posting
3. User views application summary (candidate name, applied date, status)
4. User clicks on application to view full details
5. System displays full application with resume, cover letter, answers
6. User downloads resume to local device (optional)
7. User adds evaluation notes (rating, strengths, concerns)
8. User selects application status: "Under Review", "Shortlisted", "Not Selected"
9. User clicks "Save Evaluation"
10. System updates application status and evaluation
11. System sends status update email to candidate (if configured)
12. User repeats steps 3-11 for other applications

### Post-conditions
- Application evaluation is saved with rating and notes
- Application status is updated
- Candidate receives notification of status change
- Audit log entry is created for evaluation

### Alternative Flows
- **AF1**: No applications found
  - At step 3, no applications match filter criteria
  - System displays "No applications found" message
  - User adjusts filters or waits for new applications
- **AF2**: Bulk status update
  - At step 8, user selects multiple applications
  - User applies bulk status change
  - System updates all selected applications
- **AF3**: Forward to colleague
  - At step 7, user clicks "Forward for Review"
  - User selects colleague from directory
  - System sends email notification to colleague with application link
- **AF4**: Add to talent pool
  - At step 8, user clicks "Add to Talent Pool"
  - System archives application for future reference
  - Application status set to "Talent Pool"

---

## Use Case 4: Schedule Interview

### Actor
HR Manager, Interviewer (Hiring Manager, Team Lead)

### Description
HR Manager schedules an interview with a shortlisted candidate by coordinating availability through the Calendar module.

### Pre-conditions
- Candidate application is in "Shortlisted" status
- At least one interviewer is assigned
- User is authenticated with appropriate role
- Calendar module is accessible

### Steps
1. HR Manager selects candidate application
2. HR Manager clicks "Schedule Interview"
3. System displays interview scheduling form
4. HR Manager selects interview type (Phone, Video, On-site, Panel)
5. HR Manager selects interview panel members (interviewers)
6. System connects to ksf_Calendar module
7. System retrieves interviewer availability from Calendar
8. HR Manager views available time slots
9. HR Manager selects proposed date and time
10. System checks all interviewer availability for conflicts
11. HR Manager enters interview duration (default: 60 minutes)
12. HR Manager enters location or video meeting link
13. HR Manager enters interview notes/agenda
14. HR Manager clicks "Send Interview Invitation"
15. System creates calendar events for all participants
16. System sends email invitations to candidate and interviewers
17. System updates application status to "Interview Scheduled"
18. System displays confirmation with calendar event IDs

### Post-conditions
- Calendar events created for candidate and all interviewers
- Interview invitations sent via email
- Application status updated to "Interview Scheduled"
- Interview record created linked to application

### Alternative Flows
- **AF1**: Conflict detected
  - At step 10, conflict detected for selected time
  - System displays conflict details
  - HR Manager selects different time slot
- **AF2**: Candidate requests reschedule
  - HR Manager receives reschedule request
  - HR Manager cancels existing calendar event
  - HR Manager repeats steps 6-17 with new time
  - System sends reschedule notification to all parties
- **AF3**: Add interviewer after scheduling
  - At step 1, interview already scheduled
  - HR Manager clicks "Add Interviewer"
  - HR Manager selects additional interviewer
  - System creates calendar event for new interviewer
  - System sends invitation to new interviewer
- **AF4**: No availability
  - At step 8, no common availability found
  - System displays message
  - HR Manager contacts interviewers directly for manual scheduling
- **AF5**: Cancel interview
  - At step 1, interview already scheduled
  - HR Manager clicks "Cancel Interview"
  - System cancels calendar events for all participants
  - System sends cancellation emails
  - System updates application status to "Shortlisted"

---

## Use Case 5: Approve Hiring

### Actor
HR Manager, Department Manager, Approver (Workflow角色)

### Description
Hiring approval workflow is initiated after successful interview to obtain necessary authorizations before extending job offer.

### Pre-conditions
- Candidate has completed interview(s)
- All required interview feedback is submitted
- Hiring approval workflow is configured
- User has appropriate approval authority

### Steps
1. HR Manager reviews all interview feedback
2. HR Manager determines candidate is recommended for hire
3. HR Manager clicks "Initiate Hiring Approval"
4. System connects to ksf_Workflow module
5. System creates hiring approval request with candidate details, job info, compensation
6. System routes request to configured approvers based on workflow rules
7. Approver receives notification (email/in-app)
8. Approver reviews hiring request details
9. Approver clicks "Approve" or "Reject"
10. System updates approval status
11. If additional approvers required, repeat steps 7-10
12. When final approval received, system sets approval complete
13. System sends notification to HR Manager
14. System updates application status to "Approval Granted"
15. System allows HR Manager to proceed with offer

### Post-conditions
- Hiring approval workflow is completed
- Approval status is "Approved" or "Rejected"
- Application status updated accordingly
- Audit trail created for approval decision
- If approved, HR can proceed with offer generation

### Alternative Flows
- **AF1**: Approval rejected
  - At step 9, approver clicks "Reject"
  - Approver enters rejection reason
  - System updates application status to "Approval Rejected"
  - HR Manager receives rejection notification
  - HR Manager can modify request and resubmit (return to step 3)
- **AF2**: Approval with conditions
  - At step 9, approver clicks "Approve with Conditions"
  - Approver enters conditions (e.g., salary adjustment)
  - System records conditions
  - Approval continues to next approver or completes
- **AF3**: Escalation
  - At step 7, approver does not respond within SLA
  - System escalates to backup approver or manager
  - Backup approver receives escalation notification
- **AF4**: Cancel approval request
  - At step 6, request is pending
  - HR Manager clicks "Cancel Request"
  - System cancels workflow
  - System updates application status to previous state

---

## Use Case 6: Create New Hire Record

### Actor
HR Manager

### Description
After hiring approval, HR Manager creates a new hire record in the HRM system for the selected candidate.

### Pre-conditions
- Candidate has accepted job offer
- Application is in "Approval Granted" or "Offer Accepted" status
- ksf_HRM module is accessible and functional
- Candidate consent for data transfer is obtained (if required)

### Steps
1. HR Manager selects approved candidate application
2. HR Manager clicks "Create New Hire Record"
3. System displays new hire form with pre-filled data from application
4. HR Manager verifies and completes employee information:
   - Personal details (name, DOB, contact)
   - Emergency contact
   - Tax information (if applicable)
   - Banking details for payroll
   - Start date
   - Initial position and department assignment
   - Reporting manager
   - Employment type confirmation
   - Compensation details
5. HR Manager reviews all entered information
6. HR Manager clicks "Create Employee Record"
7. System validates required fields
8. System connects to ksf_HRM module via API
9. System creates employee record in ksf_HRM database
10. System receives employee ID from ksf_HRM
11. System links employee ID to original application
12. System updates application status to "Converted to Employee"
13. System sends employee ID and details to ksf_Onboarding module
14. System displays confirmation with employee ID

### Post-conditions
- Employee record created in ksf_HRM with unique employee ID
- Application linked to new employee record
- Application status updated to "Converted to Employee"
- New hire data sent to ksf_Onboarding module
- Audit log entry created

### Alternative Flows
- **AF1**: Duplicate employee record
  - At step 9, system detects existing employee with same details
  - System displays duplicate warning
  - HR Manager verifies identity and confirms creation or cancels
- **AF2**: ksf_HRM module unavailable
  - At step 8, connection to ksf_HRM fails
  - System displays error message
  - HR Manager can retry or manually create record later
- **AF3**: Candidate declines offer
  - At step 1, candidate has declined offer
  - Application status is "Offer Declined"
  - Create New Hire option is disabled
- **AF4**: Data validation failure
  - At step 7, validation fails
  - System highlights invalid fields
  - HR Manager corrects and resubmits

---

## Use Case 7: Trigger Onboarding Process

### Actor
HR Manager, System (Automatic)

### Description
When a new hire record is created, the onboarding process is automatically triggered in the Onboarding module.

### Pre-conditions
- New hire record exists in ksf_HRM (from Use Case 6)
- ksf_Onboarding module is accessible and functional
- Onboarding workflow is configured for the position type

### Steps
1. System detects new hire record creation event
2. System automatically extracts onboarding trigger data:
   - Employee ID
   - Employee name
   - Department
   - Position
   - Start date
   - Reporting manager
   - Assigned onboarding checklist template
3. System connects to ksf_Onboarding module
4. System creates onboarding instance for new hire
5. System assigns onboarding tasks based on template:
   - IT equipment provisioning
   - Access credentials setup
   - Orientation scheduling
   - Training assignments
   - Documentation completion
   - Team introduction
6. System sets onboarding start date (typically start date)
7. System sets target completion date
8. System notifies relevant stakeholders:
   - New hire receives welcome email with onboarding details
   - IT department notified of equipment request
   - Manager notified of orientation scheduling
9. System logs onboarding initiation
10. System updates application status to "Onboarding Started"

### Post-conditions
- Onboarding instance created in ksf_Onboarding module
- Onboarding tasks assigned to appropriate parties
- New hire and manager receive notifications
- Application status updated to "Onboarding Started"
- Progress tracking enabled

### Alternative Flows
- **AF1**: Delayed start date
  - At step 2, employee start date is in future (delayed start)
  - System creates onboarding instance with future start
  - Tasks scheduled based on adjusted timeline
- **AF2**: Custom onboarding template
  - At step 5, position requires custom checklist
  - System applies position-specific template
  - Standard and custom tasks merged
- **AF3**: ksf_Onboarding module unavailable
  - At step 3, connection fails
  - System logs failure
  - HR Manager manually triggers onboarding later
  - System displays warning but continues
- **AF4**: Onboarding already in progress
  - At step 1, duplicate trigger detected
  - System checks existing onboarding instance
  - System updates existing instance or creates new based on rules

---

## Use Case 8: Reject Application

### Actor
HR Manager, Hiring Manager, System (Automatic)

### Description
Application is rejected at any stage of the recruitment process due to candidate disqualification, withdrawal, or position closure.

### Pre-conditions
- Application exists with status other than "Rejected" or "Withdrawn"
- User has appropriate role to reject applications

### Steps
1. User selects application for rejection
2. User clicks "Reject Application"
3. System displays rejection reason form
4. User selects rejection reason:
   - Not qualified (skills/experience)
   - Failed assessment/interview
   - Position filled
   - Candidate withdrew
   - Salary expectations mismatch
   - Background check failed
   - Other
5. User enters detailed rejection notes (optional)
6. User selects communication preference:
   - Send rejection email
   - No email notification
7. User clicks "Confirm Rejection"
8. System validates rejection data
9. System updates application status to "Rejected"
10. If email selected, system sends rejection notification to candidate
11. System logs rejection with timestamp, reason, and user
12. System updates recruitment metrics
13. System displays confirmation

### Post-conditions
- Application status set to "Rejected"
- Rejection reason and notes stored
- Candidate receives email notification (if selected)
- Application removed from active recruitment pipeline
- Audit trail created with rejection details

### Alternative Flows
- **AF1**: Bulk rejection
  - At step 1, user selects multiple applications
  - User clicks "Bulk Reject"
  - User selects common rejection reason
  - System rejects all selected applications
  - Individual emails sent if email option selected
- **AF2**: Candidate withdraws
  - Candidate submits withdrawal request
  - System processes as rejection with "Candidate Withdrew" reason
  - No rejection email sent to candidate
- **AF3**: Position cancelled during recruitment
  - HR Manager closes job posting
  - System prompts for rejection of all active applications
  - HR Manager selects batch rejection
  - All applicants rejected with "Position Cancelled" reason
- **AF4**: Undo rejection
  - At step 9, within configurable time window
  - User clicks "Undo Rejection"
  - System restores previous application status
  - Rejection email is not sent or retraction sent
- **AF5**: Rejection appeal
  - Candidate submits appeal request
  - HR Manager reviews appeal
  - If appeal approved, HR Manager restores application

---

## Integration Summary

| Use Case | Integration | Data Exchanged |
|----------|-------------|----------------|
| UC4: Schedule Interview | ksf_Calendar | Availability, Calendar Events |
| UC5: Approve Hiring | ksf_Workflow | Approval Requests, Decisions |
| UC6: Create New Hire | ksf_HRM | Employee Record, Personnel Data |
| UC7: Trigger Onboarding | ksf_Onboarding | New Hire Details, Task Assignment |

---

## Revision History

| Version | Date | Author | Changes |
|---------|------|--------|---------|
| 1.0.0 | 2026-05-13 | System | Initial use case specification |
