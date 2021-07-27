import "./index.scss";
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from '@wordpress/components';


/**
 * This function will run all the time
 * when something changes in the Admin Page
 */
function ourStartFunction(){
  wp.data.subscribe(() =>{
    console.log("Hello");
  })
}

ourStartFunction();

/**
 * "wp" comes from the array('wp-blocks') in index.php dependencies
 */
 wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
  title: "Are You Paying Attention?",
  icon: "smiley",
  category: "common",
  attributes: {
    question: {type: "string"},
    answers: {type: "array", default:["red", "Blue"]},
    correctAnswer: {type: "number", default: undefined}
  },
  edit: EditComponent,

  //Controls what the public will see in my content
  save: function(props){    
    return null
  }  
});


function EditComponent(props) {
    
  function updateQuestion(value) {
    props.setAttributes({question: value});
  }

  function deleteAnswer(indexDelete){
    const newAnswers = props.attributes.answers.filter((answer, index) =>{
      return index != indexDelete;
    });
    props.setAttributes({answers: newAnswers});
    if(indexDelete == props.attributes.correctAnswer){
      props.setAttributes({correctAnswer: undefined});
    }

  }

  function markAsCorrect(index){
    props.setAttributes({correctAnswer: index});
  }

  return (
    <div className="paying-attention-edit-block">
      <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize: "20px"}}/>
      <p style={{fontSize:"13px", margin: "20px 0 8px 0"}}>Answers:</p>
      {props.attributes.answers.map((answer, index)=>{
        return(
          <Flex>
            <FlexBlock>
              <TextControl autoFocus={answer == undefined} value={answer} onChange={(newValue)=>{
                const newAnswers = props.attributes.answers.concat([]);
                newAnswers[index]= newValue;
                props.setAttributes({answers: newAnswers});
              }}/>
            </FlexBlock>
            <FlexItem>
              <Button onClick={()=> markAsCorrect(index)}>
                <Icon className="mark-as-correct" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"}/>
              </Button>
            </FlexItem>
            <FlexItem>
              <Button isLink className="attention-delete" onClick={() => deleteAnswer(index)}>Delete</Button>
            </FlexItem>
          </Flex>
        )
      })}
      <Button isPrimary onClick={() => {
        props.setAttributes({answers: props.attributes.answers.concat([undefined])})
      }}>Add another answer</Button>
    </div>
  )
}

