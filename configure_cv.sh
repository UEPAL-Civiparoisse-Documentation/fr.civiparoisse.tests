#!/bin/bash
cv --cwd=/app setting:set allow_alert_autodismissal=0
cv --cwd=/app api system.flush

cv --cwd=/app api contact.create display_name="FoyerSupport" sort_name="FoyerSupport" legal_name="FoyerSupport" household_name="FoyerSupport" contact_type="Household"

cv --cwd=/app api contact.create last_name="SUPPORT" first_name="Mère" contact_type="Individual"
cv --cwd=/app api contact.create last_name="SUPPORT" first_name="Père" contact_type="Individual"
cv --cwd=/app api contact.create last_name="SUPPORT" first_name="Frère" contact_type="Individual"
cv --cwd=/app api contact.create last_name="SUPPORT" first_name="Soeur" contact_type="Individual"
cv --cwd=/app api contact.create last_name="SUPPORT" first_name="Conjoint" contact_type="Individual"
cv --cwd=/app api group.create name="GRPSUPPORT" title="GRPSUPPORT"
cv --cwd=/app api tag.create name="TAGSUPPORT"
cv --cwd=/app api group.create name="GRPAUX" title="GRPAUX"
cv --cwd=/app api tag.create name="TAGAUX"
cv --cwd=/app api contact.create display_name="FoyerSupportAddr" sort_name="FoyerSupportAddr" legal_name="FoyerSupportAddr" household_name="FoyerSupportAddr" contact_type="Household"

foyerAddrId=`cv --cwd=/app api contact.get household_name="FoyerSupportAddr" --out shell|grep "^id='"|cut -d "'" -f 2`

cv --cwd=/app api4 Address.create +v contact_id="${foyerAddrId}"  checkPermissions="0" +v street_number="1B" +v street="Quai Saint-Thomas" +v postal_code="67081" +v city="STRASBOURG" +v country_id:name="France" +v state_province_id:name="Bas-Rhin" +v is_primary="1" +v location_type_id:name="Domicile"

cv --cwd=/app api contact.create organization_name="ORGANISATIONSUPPORT" contact_type="organization"

customQuartier=`cv --cwd=/app api4 CustomField.get +w 'name="Quartier"' +s 'id' +l 0 --out csv|tail -1`


cv --cwd=/app api3 contact.create display_name=FoyerQuartierA  sort_name=FoyerQuartierA legal_name=FoyerQuartierA household_name=FoyerQuartierA contact_type=household custom_${customQuartier}=49
cv --cwd=/app api3 contact.create display_name=FoyerQuartierB  sort_name=FoyerQuartierB legal_name=FoyerQuartierB household_name=FoyerQuartierB contact_type=household custom_${customQuartier}=50

cv --cwd=/app api4 Event.create +v title=EvenementSupport +v event_type_id:name=Exhibition +v 'start_date=2023-07-01 00:00:00' +v default_role_id:name=Volunteer

mereId=`cv --cwd=/app api contact.get sort_name="SUPPORT, Mère" --out shell|grep "^id='"|cut -d "'" -f 2`
pereId=`cv --cwd=/app api contact.get sort_name="SUPPORT, Père" --out shell|grep "^id='"|cut -d "'" -f 2`
frereId=`cv --cwd=/app api contact.get sort_name="SUPPORT, Frère" --out shell|grep "^id='"|cut -d "'" -f 2`
soeurId=`cv --cwd=/app api contact.get sort_name="SUPPORT, Soeur" --out shell|grep "^id='"|cut -d "'" -f 2`

cv --cwd=/app api3  email.create contact_id=${mereId} location_type_id=1 email="support.mere@test.test" is_primary=true is_bulkmail=true
cv --cwd=/app api3  email.create contact_id=${pereId} location_type_id=1 email="support.pere@test.test" is_primary=true is_bulkmail=true
cv --cwd=/app api3  email.create contact_id=${frereId} location_type_id=1 email="support.frere@test.test" is_primary=true is_bulkmail=true
cv --cwd=/app api3  email.create contact_id=${soeurId} location_type_id=1 email="support.soeur@test.test" is_primary=true is_bulkmail=true

cv --cwd=/app api group.create name="GRPMAIL" title="GRPMAIL" group_type=2

grpMailId=`cv --cwd=/app api group.get name="GRPMAIL" --out shell|grep "^id='"|cut -d "'" -f 2`

cv --cwd=/app api4 GroupContact.create +v group_id=${grpMailId} +v contact_id=${mereId}
cv --cwd=/app api4 GroupContact.create +v group_id=${grpMailId} +v contact_id=${pereId}

cv api4 Membership.create +v contact_id=${mereId} +v membership_type_id:label=Electeur·trice
