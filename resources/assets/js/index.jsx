import React from 'react';
import ReactDOM from 'react-dom';
import TemplateForm from './components/template.jsx';
import CompetencyFrameworkForm from './components/competency_framework_form.jsx';

$(() => {
  var templateForm  = document.querySelector('#template');

  if (templateForm) {
    ReactDOM.render(<TemplateForm />,templateForm);
  }

  var competencyFrameworkForm  = document.querySelector('#competency-framework-editor');
  var frameworkId = $('#competency-framework-editor').attr('data-frameworkId');

  console.log('frameworkId '+frameworkId);
  if (competencyFrameworkForm) {
        if (frameworkId) {
            ReactDOM.render(<CompetencyFrameworkForm 
          frameworkId={frameworkId}
        />,
        competencyFrameworkForm);
        }
        else {
            ReactDOM.render(<CompetencyFrameworkForm />,competencyFrameworkForm);
        }
  }
});