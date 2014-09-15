<?php

class xmlHandler {

	var $filename;		// the filename of the XML file
	var $doc;			// the document of the XML file
	var $root;			// the root element node of the document

	//constructor

	function xmlHandler($filename) {
		$this->filename = $filename;
		$this->root = null;
		$this->doc = null;
	}

	// check if the XML file exist

	function fileExist() {
		return file_exists($this->filename);
	}

	// open the XML file
	
	function openFile() {
		$rp = realpath($this->filename);

		if ($this->fileExist()) {
			$this->doc = new DOMDocument();
			$this->doc->load($rp);

			// get the root element of the document
			$this->getRootElement();
		}
		else {
			$this->doc = new DOMDocument('1.0', 'iso-8859-1');
		}
	}

	// save the XML file
	
	function saveFile() {
		$rp = realpath($this->filename);
		$this->doc->save($rp) ;
	}

	//dump the XML tree into a string

	function dumpToString() {
		return $this->doc->saveXML();
	}

	// add a root element node to the document

	function addRootElement($element_name) {

		$this->root = $this->doc->createElement($element_name);
		$this->doc->appendChild($this->root);
		return $this->root;
	}

	//get the root element node from the document

	function getRootElement() {
		return $this->root;
	}

	// add an element node to an element node

	function addElement($element, $child_name) {
		$child = $this->doc->createElement($child_name);
		$element->appendChild($child);
		return $child;
	}

	// add a text node to an element node
	
	function addText($element, $child_text) {
		$child_text_node = new DOMText($child_text);
		$element->appendChild($child_text_node);
	}

	// get an element node from the document
	
	function getElement($element_name, $index=0) {
		$node_array = $this->doc->documentElement->getElementsByTagName($element_name);
		return $node_array->item($index);
	}

	//get the chlid nodes of an element node from the document

	function getChildNodes($element_name, $index=0) {
		$node_array = $this->doc->documentElement->getElementsByTagName($element_name);
		return $node_array;
	}

	// set an attribute of an element node
	
	function setAttribute($element, $attribute_name, $value) {
		$element->setAttribute($attribute_name, $value);
	}

	// get an attribute of an element node
	
	function getAttribute($element, $attribute_name) {
		return $element->getAttribute($attribute_name);
	}
	
	// remove an element node
	
	function removeElement($element, $child) {
		$element->removeChild($child);
	}

}

?>
